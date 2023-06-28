document.addEventListener("DOMContentLoaded", () => {

    const notiModal = document.getElementById("notification-modal");
    const addContent = document.getElementById("add-content");
    const closeModal = document.getElementById("close-n");
    const openNotification = document.getElementById("open-notification");

    openNotification.addEventListener("click", ()=>{
        notiModal.showModal();
    });

    addContent.addEventListener("click", ()=>{
        notiModal.close();
    });

    closeModal.addEventListener("click", ()=>{
        notiModal.close();
    });

});