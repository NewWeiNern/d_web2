// Commented due to iphone glitchy interaction from class

// class log_modal{
//     constructor(){
//         return this;
//     }
//     toggleModal = (e, view)=>{ // displays modal 
//         e.preventDefault();
//         this.openModal();
//         this.display(view);
//     }
//     display(s){
//         switch(s){
//             case "signup" : 
//                 $(this.content).empty().append(`
//                     <form onSubmit="form.validateData(event)" method="post">
//                         <span class="close">X</span>
//                         <h1>Sign Up</h1>
//                         <label for="username"><span>Username:</span>
//                             <input type="text" name="username" id="username"/>
//                         </label>
//                         <label for="password"><span>Password:</span>
//                             <input type="password" name="password" id="password"/>
//                         </label>
//                         <label for="re-enter_password"><span>Re-Enter Password:</span>
//                             <input type="password" name="re-enter_password" id="re-enter_password"/>
//                         </label>
//                         <label for="email"><span>Email:</span>
//                             <input type="email" name="email" id="email"/>
//                         </label>
//                         <input type="submit" name="submit" id="submit" class="btn blue-btn" value="Sign Up" value="Login"/>
//                         <p class="msg">Already have an account? <a href="" onclick="form.toggleModal(event, 'login')">Login Now</a></p>
//                     </form>
                    
//                 `);
//             break;
//             case "login" : 
//                 $(this.content).empty().append(`
//                     <form onSubmit="form.validateData(event)" method="post">
//                         <span class="close">X</span>
//                         <h1>Login</h1>
//                         <label for="username"><span>Username:</span>
//                             <input type="text" name="name" id="username"/>
//                         </label>
//                         <label for="password"><span>Password:</span>
//                             <input type="password" name="pass" id="password"/>
//                         </label>
//                         <input type="submit" name="submit" id="submit" class="btn blue-btn"/>
//                         <p class="msg">Don't have an account? <a href="" onclick="form.toggleModal(event, 'signup')">Sign Up Now</a></p>
//                     </form>
                    
//                 `);
//             break;
//         }
//         $("form .close").on("click", ()=>$(this.overlay).click());
//     }
// }