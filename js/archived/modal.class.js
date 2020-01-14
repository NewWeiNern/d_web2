'use strict';
// class Modal{
//     constructor(){
//         /**
//          * Set background and content for use
//          */
//         this.overlay = document.createElement("div");
//         this.content = document.createElement("div");
//         this.opened = false;

//         this.overlay.classList.add("modal-overlay");
//         this.content.classList.add("modal-content");
//         this.overlay.appendChild(this.content);

//         this.modal_init();
//     }
//     openModal = ()=>{
//         document.body.appendChild(this.overlay);
//         this.opened = true;
//         this.overlay.animate([{opacity:0},{opacity:1}], {duration : 300, fill:"forwards"});     
//     }
//     closeModal = (e)=>{
//         if(e.target !== this.overlay)return;
//         this.opened = false;
//         this.overlay.animate([{opacity:1},{opacity:0}], {duration : 300, fill:"forwards"}).onfinish = ()=>{
//             document.body.removeChild(this.overlay);
//             $(this.content).empty();
//         };     
//     }
//     modal_init(){
//         this.overlay.onclick = this.closeModal;
//         $(this.content).empty();
//     }
// }