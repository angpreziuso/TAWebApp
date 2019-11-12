<?php

// This is a demo of writing a PHP file to interact with our Database

$dbLink = mysqli_connect('localhost', 'root', '');
mysqli_select_db($dbLink, 'clefDB');

$topicID = 0;
$classes = array( 101, 149, 159, 227, 240, 261 );
$class_titles  = array(
    "Introduction to Computer Science",
    "Introduction to Programming",
    "Advanced Computer Programming",
    "Discrete Structures I",
    "Algorithms and Data Structures",
    "Computer Systems I"
);

$class_descriptions  = array(
    "Overview class for Computer Science",
    "This class teaches the fundamentals of programming",
    "This class teaches advanced topics of programming",
    "This teaches the fundamentals of discrete math in relation to computer science",
    "This is the first actual computer science class",
    "This teaches about stuff going on under the hood"
);

$topic_titles = array (
    "PA1",
    "PA2",
    "PA3",
    "PA4",
    "Lab1",
    "Lab2",
    "Lab3",
    "Lab4",
    "Lab5"
);

$topics = array(
    "Help I dont know the thing",
    "My code is fine but it doesnt work",
    "NullPointerException at line 32",
    "I dont know how to compile",
    "My test case is failing",
    "I didnt read the project specs and I dont know what to do",
    "How do I do something in this language?",
    "I am so lost",
    "Please fix my code",
    "What is a pointer?"
);

function gen_rand_topic_row() {
    global $topicID;
    global $classes;
    global $topic_titles;
    global $topics;
    return array( 
        $topicID++, 
        $topic_titles[rand(0, count($topic_titles) - 1)], 
        $topics[rand(0, count($topics) - 1)], 
        $classes[rand(0, count($classes) - 1)] 
    );
}

function query($query){
    global $dbLink;
    $result = mysqli_query($dbLink, $query) or die(mysqli_error($dbLink));
    return $result;
}

// Clear data for demo
query("DELETE FROM Topic");
query("DELETE FROM Course");

// Add class data
for($i = 0; $i < count($classes); $i++) {
    $secID = rand(0, 3);
    $update = "INSERT INTO Course (courseID, secID, name, courseDesc) VALUES(
        " . $classes[$i] . ",
        " . $secID . ",
        \"" . $class_titles[$i] . "\",
        \"" . $class_descriptions[$i] . "\"
    )";
    query($update);
}

// Generate topic data
for($i = 0; $i < 20; $i++) {
    $topic = gen_rand_topic_row();
    $result = implode(", ", $topic);
    $update = "INSERT INTO Topic (topicID, title, topicDesc, courseID) VALUES ( 
        " . $topic[0] . ",
        \"" . $topic[1] . "\",
        \"" . $topic[2] . "\",
        " . $topic[3] . "
    )";
    query($update);
}

$result = query("SELECT * FROM Topic INNER JOIN Course USING (courseID) ORDER BY topicID ASC");

if(mysqli_num_rows($result) == 0) {
    echo "<h3>No rows returned from the database</h3>";
} else {
    // Print the column names as the headers of a table
    echo "<table><tr>";
    for($i = 0; $i < mysqli_num_fields($result); $i++) {
        $field_info = mysqli_fetch_field($result);
        echo "<th>{$field_info->name}</th>";
    }

    // Print the data
    while($row = mysqli_fetch_row($result)) {
        echo "<tr>";
        foreach($row as $_column) {
            echo "<td>{$_column}</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}

?>