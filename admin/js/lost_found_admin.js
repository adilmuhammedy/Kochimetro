document.addEventListener("DOMContentLoaded", () => {
    const modal1 = document.getElementById("lost-item-modal");
    const openLostItem = document.getElementById("open-lost-item-modal");
    const closeLostitem = document.getElementById("close-lost-item-modal");
    const closeLostModal = document.getElementById("close-lost-modal");

    openLostItem.addEventListener("click", ()=>{
        modal1.showModal();
    })

    closeLostitem.addEventListener("click", ()=>{
        modal1.close();
    });

    closeLostModal.addEventListener("click", ()=>{
        modal1.close();
    });

});
