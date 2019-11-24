curl -X POST -H \
    "Content-Type: application/json" -d \
    '{"email":"moorena@dukes.jmu.edu", "password":"n-password", "role":1, "origin":"login-submit"}' \
    localhost/clef/api/acnt/login.php