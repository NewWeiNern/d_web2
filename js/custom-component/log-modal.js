"use strict";
class Log_Modal{
    constructor() {
        let ele= (e)=>document.createElement(e);
        this.overlay = ele("div");
        this.content = ele("div");
        this.opened = false;

        $(this.overlay)
        .addClass("modal-overlay")
        .append(
            $(this.content).addClass("modal-content")
        )
        .click((e)=>{this.closeModal(e);});

    }
    openModal(e){
        $(document.body).append(this.overlay);
        this.opened = true;
        $(this.overlay).animate({
            opacity : 1
        }, 300);
        return false;
    }
    closeModal(e){
        if(e.target !== this.overlay)return;
        this.opened = false;
        $(this.overlay).animate({opacity:0}, 300, ()=>{
            document.body.removeChild(this.overlay);
            $(this.content).empty();
        });
        return false;
    }
    toggleModal(e){
        this.openModal(e);
        this.display(e.target.dataset.type || e);
    }
    display(s){
    switch(s){
        case "signup" : 
            $(this.content).empty().append(`
                <form action='res/sign_up_verify.php' onSubmit="Form.validate(event, 'signup')" method="post"  enctype="multipart/form-data">
                    <span class="close">X</span>
                    <h1>Sign Up</h1>
                    <label for="image"></label>
                    <input type="file" id="image" name="image"/>
                    <label for="username"><span>Username:</span>
                        <input type="text" name="name" id="username"/>
                    </label>
                    <label for="password"><span>Password:</span>
                        <input type="password" name="pass" id="password"/>
                    </label>
                    <label for="re-enter_password"><span>Re-Enter Password:</span>
                        <input type="password" name="pass_1" id="re-enter_password"/>
                    </label>
                    <label for="email"><span>Email:</span>
                        <input type="email" name="email" id="email"/>
                    </label>
                    <input type="submit" name="submit" id="submit" class="btn blue-btn" value="Sign Up" value="Login"/>
                    <p class="msg">Already have an account? <a href="javascript:void(0)" data-type="login" onclick="((e)=>{modal.toggleModal(e)})(event)">Login Now</a></p>
                </form>
                
            `);
            $(this.content).find("#image").on("change", function(e){
                const img = e.target.files[0],
                reader = new FileReader();
                reader.readAsDataURL(img);
                reader.onload = e=>{
                     $(this).prev().css("backgroundImage", 'url('+e.target.result+')');
                }
            });
        break;
        case "login" : 
            $(this.content).empty().append(`
                <form onSubmit="Form.validate(event, 'login')" method="post">
                    <span class="close">X</span>
                    <h1>Login</h1>
                    <label for="username"><span>Username:</span>
                        <input type="text" name="name" id="username"/>
                    </label>
                    <label for="password"><span>Password:</span>
                        <input type="password" name="pass" id="password"/>
                    </label>
                    <input type="submit" name="submit" id="submit" class="btn blue-btn"/>
                    <p class="msg">Don't have an account? <a href="javascript:void(0)" data-type="signup" onclick="((e)=>{modal.toggleModal(e)})(event)">Sign Up Now</a></p>
                </form>
                
            `);
        break;
    }
    $("form .close").on("click", ()=>$(this.overlay).click());
}

}
