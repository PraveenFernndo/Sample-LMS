function displayMenu() {
    var m = document.getElementById("smallMenu");

    m.classList.toggle("d-none");

}

function register() {
    var fname = document.getElementById("firstName").value;
    var lname = document.getElementById("lastName").value;
    var gender = document.getElementById("gender").value;
    var grade = document.getElementById("grade").value;
    var address = document.getElementById("address").value;
    var school = document.getElementById("school").value;
    var password = document.getElementById("password").value;
    var email = document.getElementById("email").value;
    var mobile = document.getElementById("mobile").value;

    var form = new FormData();
    form.append("fname", fname);
    form.append("lname", lname);
    form.append("gender", gender);
    form.append("grade", grade);
    form.append("address", address);
    form.append("school", school);
    form.append("password", password);
    form.append("email", email);
    form.append("mobile", mobile);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                alert("Registration Success");
                window.location = "login.php";
            } else {
                document.getElementById("errorMesssage").innerHTML = t;
            }
        }
    }

    r.open("POST", "studentRegistrationProcess.php", true);
    r.send(form);

}

function registerTeacher() {
    var fname = document.getElementById("firstName");
    var lname = document.getElementById("lastName");
    var gender = document.getElementById("gender");
    var address = document.getElementById("address");
    var institute = document.getElementById("institute");
    var password = document.getElementById("password");
    var email = document.getElementById("email");
    var mobile = document.getElementById("mobile");
    var qualification = document.getElementById("qualification");
    var description = document.getElementById("description");
    var degree = document.getElementById("degree");
    var classDetails = document.getElementById("classDetails");

    var form = new FormData();
    form.append("fname", fname.value);
    form.append("lname", lname.value);
    form.append("gender", gender.value);
    form.append("address", address.value);
    form.append("institute", institute.value);
    form.append("password", password.value);
    form.append("email", email.value);
    form.append("mobile", mobile.value);
    form.append("qualification", qualification.files[0]);
    form.append("description", description.value);
    form.append("degree", degree.value);
    form.append("degree", degree.value);
    form.append("classDetails", classDetails.value);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                alert("Registration Success, Please Wait....");
                window.location = "teacherConfirmation.php";
            } else {
                document.getElementById("errorMesssage").innerHTML = t;
            }
        }
    }

    r.open("POST", "teacherRegistrationProcess.php", true);
    r.send(form);

}


function registerAsTeacher() {
    window.location = "teacherRegistration.php";
}

function registerAsStudent() {
    window.location = "studentRegistration.php";
}

function selectRegisterType() {
    window.location = "selectRegisterType.php";
}

function login() {

    var email = document.getElementById("email");
    var password = document.getElementById("password");
    var rememberMe = document.getElementById("rememberMe");

    var form = new FormData();

    form.append("email", email.value);
    form.append("password", password.value);
    form.append("rem", rememberMe.checked);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Teacher Login Successfull") {
                alert(t);
                window.location = "teacherProfile.php";
            } else if (t == "User Login Successfull") {
                alert(t);
                window.location = "studentProfile.php";
            } else if (t == "Admin Login Successfull") {
                alert(t);
                window.location = "adminPanel.php";
            } else if (t == "Admin Login Successfull") {
                alert(t);
                window.location = "adminPanel.php";
            } else if (t == "Waiting") {
                alert("Please Wait...");
                window.location = "teacherConfirmation.php";
            } else {
                document.getElementById("errorDisplay").innerHTML = t;
            }
        }
    }

    r.open("POST", "loginProcess.php", true);
    r.send(form);


}

function changeProfilePicture() {
    var image = document.getElementById("profileImage");
    var file = document.getElementById("profileImageUploader");

    file.onchange = function() {
        var file1 = this.files[0];
        var url = window.URL.createObjectURL(file1);
        image.src = url;
    }

}

function studentProfileUpdate() {
    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var address = document.getElementById("address");
    var school = document.getElementById("school");
    var profile_image = document.getElementById("profileImage");
    var image = document.getElementById("profileImageUploader");

    var form = new FormData();
    form.append("fname", fname.value);
    form.append("lname", lname.value);
    form.append("address", address.value);
    form.append("school", school.value);
    form.append("profileImage", image.files[0]);
    form.append("image", profile_image.src);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "Success") {
                alert("Profile Details Updated Successfully");
            } else {
                alert(t);
            }

        }
    }

    r.open("POST", "studentProfileUpdateProcess.php", true);
    r.send(form);

}

function teacherProfileUpdate() {
    var fname = document.getElementById("fname").value;
    var lname = document.getElementById("lname").value;
    var institute = document.getElementById("institute").value;
    var description = document.getElementById("description").value;
    var address = document.getElementById("address").value;

    var profileImage = document.getElementById("profileImageUploader");


    var form = new FormData();
    form.append("fname", fname);
    form.append("lname", lname);
    form.append("institute", institute);
    form.append("description", description);
    form.append("address", address);
    form.append("profile_image", profileImage.files[0]);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            alert(t);
        }
    }

    r.open("POST", "teacherProfileUpdateProcess.php", true);
    r.send(form);

}

function teacherRequestAcceptProcess(n, e) {
    var number = n;
    var email = e;

    var f = new FormData();
    f.append("email", email);
    f.append("number", number);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Request Accepted") {
                alert(t);
                sendVerificationEmailToTeacher(email);
                location.reload();
                document.getElementById("classAssignDiv").style.display = "block";
            } else if (t == "Request Rejected") {
                alert(t);
                location.reload();
            }

        }
    }

    r.open("POST", "requestProcess.php", true);
    r.send(f);

}



function sendVerificationEmailToTeacher(e) {
    var email = e;
    var f = new FormData();

    f.append("email", email);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            alert(t);
        }
    }
    r.open("POST", "sendTeacherConfirmationEmail.php", true);
    r.send(f);
}


function select() {
    var grade = document.getElementById("grade").value;
    var medium = document.getElementById("medium").value;
    var subject = document.getElementById("subject").value;
    var searchItem = document.getElementById("searchItem").value;

    var r = new XMLHttpRequest();

    var f = new FormData();
    f.append("subject", subject);
    f.append("medium", medium);
    f.append("grade", grade);
    f.append("searchItem", searchItem);

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "") {
                alert("Cannot Find...");
                location.reload();
            } else {
                document.getElementById("viewArea").innerHTML = t;
            }
        }
    }

    r.open("POST", "advancedSearchProcess.php", true);
    r.send(f);

}

function videoUploader(i1, i2, i3) {
    var url = document.getElementById("videoUrl").value;
    var description = document.getElementById("videoDescription").value;
    var grade_id = i1;
    var subject_id = i2;
    var medium_id = i3;
    var form = new FormData();

    form.append("url", url);
    form.append("grade_id", grade_id);
    form.append("subject_id", subject_id);
    form.append("medium_id", medium_id);
    form.append("description", description);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            alert(t);
            location.reload();
        }
    }

    r.open("POST", "videoProcess.php", true);
    r.send(form);

}

function noteUploader(i1, i2, i3) {
    var note = document.getElementById("fileChooser");
    var description = document.getElementById("fileDescription").value;
    var grade_id = i1;
    var subject_id = i2;
    var medium_id = i3;
    var form = new FormData();

    form.append("file", note.files[0]);
    form.append("grade_id", grade_id);
    form.append("subject_id", subject_id);
    form.append("medium_id", medium_id);
    form.append("description", description);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            alert(t);
            if (t == "Video Uploaded Successfully") {
                location.reload();
            }
        }
    }

    r.open("POST", "pdfProcess.php", true);
    r.send(form);

}

function addClassToTeacher(e) {
    var tGrade = document.getElementById("teacherGrade").value;
    var tSubject = document.getElementById("teacherSubject").value;
    var fees = document.getElementById("fees").value;
    var duration = document.getElementById("duration").value;
    var medium = document.getElementById("teacherMedium").value;
    var email = e;
    var r = new XMLHttpRequest();
    var f = new FormData();

    f.append("tGrade", tGrade);
    f.append("fees", fees);
    f.append("duration", duration);
    f.append("tSubject", tSubject);
    f.append("email", email);
    f.append("medium", medium);

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            alert(r.responseText);

            if (r.responseText == "Teacher added to new class successfully") {
                location.reload();
            }
        }
    }

    r.open("POST", "teacherClassAssign.php", true);
    r.send(f);

}

function addNewSubject() {
    var subject = document.getElementById("subName");

    var f = new FormData();
    f.append("sub", subName.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            alert(r.responseText);
            location.reload();
        }
    }

    r.open("POST", "addSubjectProcess.php", true);
    r.send(f);

}

function addNewGrade() {
    var grade = document.getElementById("new_grade");

    var f = new FormData();
    f.append("grade", grade.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            alert(r.responseText);
            location.reload();
        }
    }

    r.open("POST", "addGradeProcess.php", true);
    r.send(f);

}

function adminManageStudent() {
    var email = document.getElementById("student_email").value;
    window.location = "adminPanel.php?se=" + email;
}

function adminManageTeacher() {
    var email = document.getElementById("teacherEmail").value;
    window.location = "adminPanel.php?email=" + email;

}

function removeClass(e, g, s) {
    var email = e;
    var grade = g
    var subject = s;
    var r = new XMLHttpRequest();
    var f = new FormData();

    f.append("email", email);
    f.append("subject", subject);
    f.append("grade", grade);

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            alert(r.responseText);
            if (r.responseText == "Success") {
                location.reload();
            }
        }
    }

    r.open("POST", "removeTeacherClass.php", true);
    r.send(f);

}

function adminViewMessages(i) {
    var id = i;
    var statusDot = document.getElementById("statusDot");

    var r = new XMLHttpRequest();
    r.open("GET", "messageProcess.php?i=" + id, true);
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            statusDot.style.backgroundColor = "green";
            window.location = "viewMessage.php?i=" + id;
        }
    }
    r.send();


}

function studentViewMessages(i) {
    var id = i;
    var statusDot = document.getElementById("statusDot");

    var r = new XMLHttpRequest();
    r.open("GET", "messageProcess.php?i=" + id, true);
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            statusDot.style.backgroundColor = "green";
            window.location = "viewMessage.php?i=" + id;
        }
    }
    r.send();


}

function teacherViewMessages(i) {
    var id = i;
    var statusDot = document.getElementById("statusDot");

    var r = new XMLHttpRequest();
    r.open("GET", "messageProcess.php?i=" + id, true);
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            statusDot.style.backgroundColor = "green";
            window.location = "viewMessage.php?i=" + id;
        }
    }
    r.send();


}

// function adminViewStudentMessages(i, si) {
//     var id = i;
//     var student_id = si;
//     var statusDot = document.getElementById("statusDot");

//     var r = new XMLHttpRequest();
//     r.open("GET", "messageProcess.php?i=" + id, true);
//     r.onreadystatechange = function() {
//         if (r.readyState == 4) {
//             statusDot.style.backgroundColor = "green";
//             window.location = "viewStudentMessages.php?student_id=" + student_id;
//         }
//     }
//     r.send();


// }

function sendMsg(m_id) {
    var msg_txt = document.getElementById("msgTxt");
    var message_id = m_id;

    var f = new FormData();

    f.append("mt", msg_txt.value);
    f.append("message_id", message_id);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                location.reload();
            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "sendMessageProcess.php", true);
    r.send(f);

}

function newMessage(e) {
    var msg_txt = document.getElementById("msgTxt");
    var email = e;
    var f = new FormData();

    f.append("mt", msg_txt.value);
    f.append("student_email", email);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                location.reload();
            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "newMessageProcess.php", true);
    r.send(f);

}

function messageToAdmin(e) {
    var msg_txt = document.getElementById("msgTxt");
    var email = e;
    var f = new FormData();

    f.append("mt", msg_txt.value);
    f.append("student_email", email);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                location.reload();
            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "StudentMessageProcess.php", true);
    r.send(f);

}

function teacherMessageToStudent(e1, e2) {
    var msg_txt = document.getElementById("msgTxt");
    var student_email = e1;
    var teacher_email = e2;
    var f = new FormData();

    f.append("mt", msg_txt.value);
    f.append("student_email", student_email);
    f.append("teacher_email", teacher_email);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                location.reload();
            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "teacherToStudentMessageProcess.php", true);
    r.send(f);

}

function teacherMessageToAdmin(e1) {
    var msg_txt = document.getElementById("msgTxt");
    var teacher_email = e1;
    var f = new FormData();

    f.append("mt", msg_txt.value);
    f.append("teacher_email", teacher_email);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                location.reload();
            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "teacherToAdminMessageProcess.php", true);
    r.send(f);

}

function messageToTeacher(e1, e2) {
    var msg_txt = document.getElementById("msgTxt");
    var student_email = e1;
    var teacher_email = e2;
    var f = new FormData();

    f.append("mt", msg_txt.value);
    f.append("student_email", student_email);
    f.append("teacher_email", teacher_email);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                location.reload();
            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "StudentToTeacherMessageProcess.php", true);
    r.send(f);

}

function addtoWishlist(uid, gid, sid, tid, mid) {
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "A") {
                location.reload();
            } else if (t == "Removed") {
                location.reload();
            } else {
                alert(t);
            }
        }
    }

    r.open("GET", "addWishListProcess.php?uid=" + uid + "&&gid=" + gid + "&&sid=" + sid + "&&tid=" + tid + "&&mid=" + mid, true);
    r.send();
}

function addtoFavourite(uid, gid, sid, tid, mid) {
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "A") {
                location.reload();
            } else if (t == "Removed") {
                location.reload();
            } else {
                alert(t);
            }
        }

    }

    r.open("GET", "addFavouriteProcess.php?uid=" + uid + "&&gid=" + gid + "&&sid=" + sid + "&&tid=" + tid + "&&mid=" + mid, true);
    r.send();
}

function removeFavouriteClass(i) {
    var id = i;

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            alert(r.responseText);
            if (r.responseText == "Successfully Removed") {
                location.reload();
            }

        }
    }

    r.open("GET", "removeFavouriteClassProcess.php?i=" + id, true);
    r.send();
}

function addNewNews() {
    var news = document.getElementById("news").value;
    var f = new FormData();
    f.append("news", news);
    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            alert(t);
            location.reload();
        }
    }

    r.open("POST", "newsProcess.php", true);
    r.send(f);
}

function removeNews() {
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            alert(r.responseText);
        }
    }
    r.open("POST", "newsRemove.php", true);
    r.send();
}

function showPassword() {
    var password = document.getElementById("password");
    var eye = document.getElementById("eyeIcon");

    if (password.type == "text") {
        password.type = "password";
        eye.className = "bi bi-eye-fill m-2 handCursor";
    } else if (password.type == "password") {
        password.type = "text";
        eye.className = "bi bi-eye-slash m-2 handCursor"
    }

}

function forgotPassword() {

    var email = document.getElementById("email");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                alert("Verification Code has sent to your email. Please check inbox.");
                var m1 = document.getElementById("fogotPasswordModel");
                bm = new bootstrap.Modal(m1);
                bm.show();
            } else {
                alert("Try again");
            }
        }



    }
    r.open("GET", "forgotPasswordProcess.php?e=" + email.value, true);
    r.send();

}

function resetPassword() {
    var e = document.getElementById("email").value;
    var np = document.getElementById("np").value;
    var rnp = document.getElementById("rnp").value;
    var vc = document.getElementById("vc").value;

    var form = new FormData();

    form.append("e", e);
    form.append("np", np);
    form.append("rnp", rnp);
    form.append("vc", vc);
    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = this.responseText;
            alert(t);
            if (t == "Sucess") {
                alert("Password Reset Successfully");
                bm.hide();
            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "resetPassword.php", true);
    r.send(form);

}

function logout() {
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location = "index.php";
            }
        }
    }

    r.open("POST", "logout.php", true);
    r.send();
}

function teacherWithdrowMoney(ci, ta) {
    var class_id = ci;
    var total_amount = ta;

    var bank = document.getElementById("bankName").value;
    var accName = document.getElementById("accName").value;
    var accNum = document.getElementById("accNum").value;
    if (total_amount > 0) {
        if (accName == "") {
            alert("Please enter account name");
        } else if (bank == "") {
            alert("Please enter bank name");
        } else if (accNum == "") {
            alert("Please enter account number");
        } else {
            var r = new XMLHttpRequest();
            var f = new FormData();

            f.append("class_id", class_id);

            r.onreadystatechange = function() {
                if (r.readyState == 4) {
                    var t = r.responseText;
                    if (t == "Success") {
                        alert(t);
                        location.reload();
                    }
                }
            }
            r.open("POST", "withdrawalProcess.php", true);
            r.send(f);
        }
    } else {
        alert("Not enough balance to withdraw");
    }
}

function doPayment(t, ci, ui) {
    var total = t;
    var class_id = ci;
    var user_id = ui;

    var accNum = document.getElementById("accNum").value;
    var bank = document.getElementById("bankName").value;
    var accName = document.getElementById("accName").value;
    if (accName == "") {
        alert("Please enter account name");
    } else if (bank == "") {
        alert("Please enter bank name");
    } else if (accNum == "") {
        alert("Please enter account number");
    } else {

        var f = new FormData();
        f.append("total", total);
        f.append("class_id", class_id);
        f.append("user_id", user_id);

        var r = new XMLHttpRequest();
        r.onreadystatechange = function() {
            if (r.readyState == 4) {
                var t = r.responseText;
                window.location = "success.php";
            }
        }

        r.open("POST", "doPaymentProcess.php", true);
        r.send(f);
    }
}