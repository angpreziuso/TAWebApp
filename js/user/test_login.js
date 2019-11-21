
import './login.js'

student_in_system = {
    email: "moorena@dukes.jmu.edu",
    password: "n-moore-login",
    role: 1
}

student_not_in_system = {
    email: "ehrlicjd@dukes.jmu.edu",
    password: "j-ehrlich-login",
    role: 1
}

ta_in_system = {
    email: "preziual@dukes.jmu.edu",
    password: "a-preziuso-login",
    role: 2
}

ta_not_in_system = {
    email: "moorena@dukes.jmu.edu",
    password: "n-moore-login",
    role: 2
}

prof_in_system = {
    email: "ehrlicjd@dukes.jmu.edu",
    password: "j-ehrlich-login",
    role: 3
}

prof_not_in_system = {
    email: "parrbt@dukes.jmu.edu",
    password: "b-parr-login",
    role: 3
}

admin_in_system = {
    email: "parrbt@dukes.jmu.edu",
    password: "b-parr-login",
    role: 4
}

admin_not_in_system = {
    email: "brakeje@dukes.jmu.edu",
    password: "j-brake-login",
    role: 4
}

tests = [
    [student_in_system, true],
    [student_not_in_system, false],
    [ta_in_system, true],
    [ta_not_in_system, false],
    [prof_in_system, true],
    [prof_not_in_system, false], 
    [admin_in_system, true],
    [admin_not_in_system, false]
]

tests.forEach(function(elem){

})
