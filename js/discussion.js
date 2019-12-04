window.addEventListener('DOMContentLoaded', (event) => {

//var categoryDescription = document.getElementsByClassName("categoryDescription");
var questionSubmitted = document.getElementById("questionSubmitButton");
var discussionSubmitted = document.getElementById("discussionFormSubmit");
var catrgoryDesc;

var newCategoryDiv; 
var categoryTitleButton;
var newQuestionButton;

discussionSubmitted.addEventListener("click", function(event) {
    
    event.preventDefault();

    createNewDiscussion();

    newQuestionButton.addEventListener("click", function(event){
        var modal = document.getElementById("modalQuestionPresent");
        modal.style.display = "block";
      });

    categoryTitleButton.innerHTML = catrgoryDesc;
    newCategoryDiv.classList.add("discussionCategory");

    newCategoryDiv.appendChild(categoryTitleButton);
    newCategoryDiv.appendChild(newQuestionButton);

    var category = document.getElementsByClassName("discussionCategory");
    var i;

    console.log(category);

        for(i = 0; i < category.length; i++)
        {       
            var children = category[i].childNodes; // the categoryDescription button

            children[0].addEventListener("click", function(){
                
                console.log("clicked");

                var panel = this.nextElementSibling;

                if(children[0].style.display != "none" || children[0].style.display == null)
                {
                    category.style.display = "none"
                }
                else
                {
                    category.style.display = "block"
                }
            });            
        } 


    

    document.body.appendChild(newCategoryDiv);

    //Needs to create a new div that has a button which contains the cateogry filled out by the user
    // Also needs to have an Ask a Question Button
    //Create an emtpy table??

});


function createNewDiscussion()
{
    //Create the dom elements of the discussion
    newCategoryDiv = document.createElement("div"); 
    categoryTitleButton = document.createElement("button"); 
    newQuestionButton = document.createElement("button"); 
    
    newCategoryDiv.classList.add("discussionCategory");
    

    catrgoryDesc = document.getElementById("categoryDescription").value; 
    document.getElementById('modalDiscussionPresent').style.display='none';

    styleCategory();
}

function styleCategory()
{
    newCategoryDiv.style.margin = "0 auto";
    newCategoryDiv.style.width = "1000px";
    newCategoryDiv.style.height = "250px";
    newCategoryDiv.style.marginBottom = "100px";
    newCategoryDiv.style.backgroundColor = "white";
    newCategoryDiv.classList.add("discussionCategory");

    categoryTitleButton.style.width = "80%";
    categoryTitleButton.style.height = "20%";
    categoryTitleButton.style.marginLeft = "100px";
    categoryTitleButton.style.marginTop = "20px";
    
    newQuestionButton.classList.add("btn");
    newQuestionButton.classList.add("themeButton");

    
    newQuestionButton.style.margin = "0 auto";
    newQuestionButton.style.display = "block";
    newQuestionButton.style.color = "white";
    newQuestionButton.style.borderColor = "#562e72";
    newQuestionButton.style.marginBottom = "30px";
    newQuestionButton.innerHTML = "Ask a Question"
    newQuestionButton.style.background = "#562e72";
}



questionSubmitted.addEventListener("click", function(event) {
    event.preventDefault();

    var questionDescription = document.getElementById("questionDescription").value;
    var questionDetails = document.getElementById("detailsTextArea").value;

    var myTable = document.createElement("table");
    myTable.setAttribute("id", "myTable");

    newCategoryDiv.appendChild(myTable);

    // var table = document.getElementById("forumTable");

    var defaultRow = myTable.insertRow(0);
    var defaultCell1 = defaultRow.insertCell(0);
    var defaultCell2 = defaultRow.insertCell(1);
    var defaultCell3 = defaultRow.insertCell(2);

    defaultRow.style.border = "1px solid #808080";
    myTable.style.width = "80%";
    myTable.style.margin = "0 auto";
    

    defaultCell1.innerHTML = "Question";
    defaultCell2.innerHTML = "Author"
    defaultCell3.innerHTML = "Responses"


    defaultCell1.style.paddingRight = "500px";
    defaultCell2.style.paddingRight = "200px";
 

    defaultCell1.style.color = "#808080";
    defaultCell2.style.color = "#808080";
    defaultCell3.style.color = "#808080";


    var row = myTable.insertRow(1);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);


    row.style.border = "1px solid #808080";

    var question = document.createElement("a");
    var link = document.createTextNode(questionDescription.innerHTML); 
    console.log(link);
    question.appendChild(link);
    question.href = "#";  

   // question.innerHTML = questionDescription;

    cell1.appendChild(question);
    cell2.innerHTML = "Comes from database email";
    cell3.innerHTML = "0";


    document.getElementById('modalQuestionPresent').style.display='none';

});



})