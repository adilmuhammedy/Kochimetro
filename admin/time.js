document.addEventListener("DOMContentLoaded", () => {
    const modal1 = document.getElementById("time-modal");
    const openModal = document.getElementById("open-time");
    const closeModal = document.getElementById("close-modal");

    openModal.addEventListener("click", ()=>{
        modal1.showModal();
    })

    closeModal.addEventListener("click", ()=>{
        modal1.close();
    });

});
