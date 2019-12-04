JotForm.setConditions([{
    "action": {
        "field": "21",
        "visibility": "Show"
    },
    "link": "Any",
    "terms": [{
        "field": "11",
        "operator": "equals",
        "value": "Other"
    }],
    "type": "field"
}]);
JotForm.init(function() {
    setTimeout(function() {
        $('input_9').hint('ex: myname@example.com');
    }, 20); /*INIT-END*/
});
JotForm.prepareCalculationsOnTheFly([null, null, {
    "name": "submitForm",
    "qid": "2",
    "text": "Submit Form",
    "type": "control_button"
}, {
    "name": "fullName",
    "qid": "3",
    "text": "Full Name",
    "type": "control_fullname"
}, null, null, null, null, {
    "name": "contactNo",
    "qid": "8",
    "text": "Contact No.",
    "type": "control_phone"
}, {
    "name": "email9",
    "qid": "9",
    "text": "E-mail",
    "type": "control_email"
}, null, {
    "name": "whatTime",
    "qid": "11",
    "text": "What time can you work?",
    "type": "control_radio"
}, null, null, {
    "name": "days",
    "qid": "14",
    "text": "Days",
    "type": "control_checkbox"
}, null, {
    "name": "comments",
    "qid": "16",
    "text": "Comments",
    "type": "control_textarea"
}, {
    "name": "taSchedule",
    "qid": "17",
    "text": "TA Schedule Request",
    "type": "control_head"
}, null, null, null, {
    "name": "other",
    "qid": "21",
    "text": "Other",
    "type": "control_textarea"
}]);
setTimeout(function() {
    JotForm.paymentExtrasOnTheFly([null, null, {
        "name": "submitForm",
        "qid": "2",
        "text": "Submit Form",
        "type": "control_button"
    }, {
        "name": "fullName",
        "qid": "3",
        "text": "Full Name",
        "type": "control_fullname"
    }, null, null, null, null, {
        "name": "contactNo",
        "qid": "8",
        "text": "Contact No.",
        "type": "control_phone"
    }, {
        "name": "email9",
        "qid": "9",
        "text": "E-mail",
        "type": "control_email"
    }, null, {
        "name": "whatTime",
        "qid": "11",
        "text": "What time can you work?",
        "type": "control_radio"
    }, null, null, {
        "name": "days",
        "qid": "14",
        "text": "Days",
        "type": "control_checkbox"
    }, null, {
        "name": "comments",
        "qid": "16",
        "text": "Comments",
        "type": "control_textarea"
    }, {
        "name": "taSchedule",
        "qid": "17",
        "text": "TA Schedule Request",
        "type": "control_head"
    }, null, null, null, {
        "name": "other",
        "qid": "21",
        "text": "Other",
        "type": "control_textarea"
    }]);
}, 20);