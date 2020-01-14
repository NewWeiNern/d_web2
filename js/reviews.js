let selector = $(".review-form .star-container");
if(selector.length !== 0){
    try{
        let rate = new Rate(document.querySelector(".review-form .star-container")),
        labels = ["clear", "helpful", "knowledgable", "pacing"]; // how many things to rate the teacher
        var __user_result = !__user_result ? [] : __user_result;
        rate.init(labels, __user_result);
    }
    catch(e){console.log("File cannot be found"); window.location.reload()}

}

$(".comment-container .options i").click(function(){$(this).toggleClass("active")});