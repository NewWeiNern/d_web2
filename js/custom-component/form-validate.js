class Form{
    static send = false;
    constructor(){
    }
    static validate(e,t){           
        let target = e.target,
        obj = {};
        
        let formData = new FormData(target);

        for(let i = 0; i < target.length; i++){
            obj[target[i].name] = target[i].value;
        }

        if(t === "login" || !t){
            e.preventDefault();
            $.ajax({
                url : "res/user_validate.php",
                method : "POST",
                data : obj
            }).done(function(e){
                let msg = JSON.parse(e);
                if(msg.res == 1){
                    window.location.href = window.location.href;
                }else{
                    let err = msg.error,
                    p = $(document.createElement("p")),
                    after_target = target.querySelector("input[name='submit']");
                    p.addClass("err-msg");
                    p.css("width", "100%");
                    p.text(err);
                    if(!$(after_target.previousElementSibling).hasClass("err-msg")){
                        $(after_target).before(p);
                    }else{
                        $(after_target.previousElementSibling).text(err);
                    }
                    
                    // write error message code here
                }
            });
        }
        else{
            
            if(!Form.send){
                e.preventDefault();
                $.ajax({
                    url : "res/sign_up_validate.php",
                    method : "POST",
                    data : formData,
                    processData: false,
                    contentType: false,
                    // cache : false
                }).done(function(e){
                    let msg = JSON.parse(e);
                    if(msg.res == 1){
                        if(!Form.send){
                            Form.send = true;
                            $(target).submit();
                        }
                    }else{
                        let err = msg.error,
                        p = $(document.createElement("p")),
                        after_target = target.querySelector("input[name='submit']");
                        p.addClass("err-msg");
                        p.css("width", "100%");
                        p.text(err);
                        if(!$(after_target.previousElementSibling).hasClass("err-msg")){
                            $(after_target).before(p);
                        }else{
                            $(after_target.previousElementSibling).text(err);
                        }
                        
                        // write error message code here
                    }
                });
            }else{
                $(target).find("input[type='submit']").click();
            }

        }


    }
}