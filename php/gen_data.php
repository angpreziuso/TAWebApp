<?php



// This is a demo of writing a PHP file to interact with our Database

$dbLink = mysqli_connect('localhost', 'root', '');
mysqli_select_db($dbLink, 'clefDB');

$topicID = 0;
$classes = array( 101, 149, 159, 227, 261 );
$class_titles  = array(
    "Introduction to Computer Science",
    "Introduction to Programming",
    "Advanced Computer Programming",
    "Discrete Structures I",
    // "Algorithms and Data Structures",
    "Computer Systems I"
);

$class_descriptions  = array(
    "Overview class for Computer Science",
    "This class teaches the fundamentals of programming",
    "This class teaches advanced topics of programming",
    "This teaches the fundamentals of discrete math in relation to computer science",
    // "This is the first actual computer science class",
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

// 101, 149, 159, 227, 261
$nTAs = array(6, 6, 3, 2, 2);
$tas = array(
    "Avery Higgins",
    "Chelsea Le Sage",
    "Cynthia Zastudil",
    "Rebecca Woods",
    "Teddy Pugh",
    "Grant Showalter",
    "Cullen O'Hara",
    "Megan Gilbert",
    "Jeremy Kesterson",
    "Virginia Olchevski",
    "Maddie Brower",
    "Reece Adkins",
    "Maddie Hince",
    "Hannah Ripley",
    "Zeru Tadesse",
    "Matt Williams",
    "Alex Castro",
    "Courtney Taylor",
    "AJ Snarr",
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
    echo $query . "</br>";
    global $dbLink;
    $result = mysqli_query($dbLink, $query) or die(mysqli_error($dbLink));
    return $result;
}



// Clear data or add more? Unless specified, delete all data first
$clean = isset($_GET["clean"]) ? $_GET["clean"] : true;
if($clean) {
    query("DELETE FROM Topic");
    query("DELETE FROM Course");
    query("DELETE FROM UserPermissions");
    query("DELETE FROM UserRole");
    query("DELETE FROM ClefUser");
}

// Add Role Data 
query("INSERT INTO UserRole (roleID, name, roleDesc) VALUES (1, \"student\", \"JMU Computer Science Student\")");
query("INSERT INTO UserRole (roleID, name, roleDesc) VALUES (2, \"TA\", \"JMU Computer Science Teaching Assistant\")");
query("INSERT INTO UserRole (roleID, name, roleDesc) VALUES (3, \"professor\", \"JMU Computer Science Professor\")");
query("INSERT INTO UserRole (roleID, name, roleDesc) VALUES (4, \"admin\", \"TA System Administrator\")");

// Add class data
$course_offset = 0;
$secID = 0;
for($i = 0; $i < count($tas); $i++) {
    
    $update = "INSERT INTO Course (courseID, secID, name, courseDesc) VALUES(
        " . $classes[$course_offset] . ",
        " . $secID . ",
        \"" . $class_titles[$course_offset] . "\",
        \"" . $class_descriptions[$course_offset] . "\"
    )";
    query($update);
    if ($nTAs[$course_offset] - 1 == $secID) {
        $course_offset++;
        $secID = 0;
    } else {
        $secID++;
    }
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

// Generate TA user data
$course_offset = 0;
$num_written = 0;
for ($i = 0; $i < count($tas); $i++) {
    query("INSERT INTO ClefUser (userID, email, name, password) VALUES (".$i.", \"email".$i."\", \"".$tas[$i]."\",\"password\")");
    query("INSERT INTO UserPermissions (userID, roleID, courseID) VALUES (".$i.", 2, ".$classes[$course_offset].")");
    if ($nTAs[$course_offset] - 1 == $num_written) {
        $course_offset++;
        $num_written = 0;
    } else {
        $num_written++;
    }
}

// Add user and userPermissions data (at the moment this only supports TAS)
for ($i = 0; $i < count($tas); $i++) {
    
}

echo "Done";

?>