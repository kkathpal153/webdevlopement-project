// 'use strict';
// function validateForm(){
//     var inputs = document.forms["msform"].getElementsByTagName("input");
//     // https://stackoverflow.com/questions/46155/how-to-validate-an-email-address-in-javascript
//     var validateEmail = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
//     // https://www.w3resource.com/javascript/form/phone-no-validation.php
//     var validatePhone = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
//     var validateName = /^[A-Za-z]+$/;
//
//
//
//     var flag = true;
//     for (var i=0; i<inputs.length; i++){
//         var element = document.getElementById(inputs[i].id);
//         var elementValue = document.getElementById(inputs[i].id).value;
//
//         // validate email
//         if(inputs[i].id == "email"){
//             if(!validateEmail.test(String(elementValue).toLowerCase())){
//                 alert("Invalid Email Address format");
//                 element.focus();
//                 flag = false;
//             }
//
//         }
//
//         // validate password
//         else if(inputs[i].id == "password"){
//
//             if (validateName.test(elementValue)){
//                 alert("Passwords must contain atleast one number");
//                 element.focus();
//                 flag = false;
//             }
//
//             if (elementValue.length < 8){
//                 alert("Passwords must contain atleast 8 characters");
//                 element.focus();
//                 flag = false;
//             }
//
//             if (elementValue.toLowerCase() == elementValue){
//                 alert("Passwords must contain atleast one Capital letter");
//                 element.focus();
//                 flag = false;
//             }
//         }
//
//         // validate confirm password
//         else if(inputs[i].id == "cpassword") {
//             var passwordValue = document.getElementById("password").value;
//             if (elementValue !==  passwordValue){
//                 alert("Passwords do not match.");
//                 element.focus();
//                 return false;
//             }
//         }
//
//
//     }
//
//
//     if (flag == false){
//         return false;
//     }
//     else{
//         return true;
//     }
// }