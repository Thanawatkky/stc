function alertMsg(msg, type) {
    
    $(".alertMsg").addClass("alert-"+type)
    $("#txt").text(msg);
        $("#alert").animate({right: '1px'}, "slow")
        $(".alertMsg").removeClass("d-none")
        setTimeout(() => {
            $(".alertMsg").addClass("d-none")
    }, 2000);
}
function showPass() {
    const password = document.getElementById("password");
    if (password.type === "password") {
        password.type = "text";
    }else{
        password.type = "password";
    }
}
