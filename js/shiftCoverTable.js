window.addEventListener('DOMContentLoaded', (event) => {
            var shiftcoversubmit = document.getElementById("shiftcoversubmit");

            shiftcoversubmit.addEventListener("click", function(event) {    
                event.preventDefault();

                    
                var fullname1 = document.getElementById("fullname1").value;    
                var fullname2 = document.getElementById("fullname2").value;    
                var date = document.getElementById("date").value;    
                var starttime = document.getElementById("starttime").value;    
                var endtime = document.getElementById("endtime").value;

                console.log(fullname1);

                var myTable = document.createElement("table");    
                myTable.setAttribute("id", "myTable");

                    
                newCategoryDiv.appendChild(myTable);

                    
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


                    
                document.getElementById('modalQuestionPresent').style.display = 'none';

            });