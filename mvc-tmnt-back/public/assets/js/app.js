
function clickTrashBtn() {
    let deleteBtn = document.querySelectorAll('.delete_btn');
    for(let i = 0;i < deleteBtn.length;i++) {
        deleteBtn[i].addEventListener("click", fonctionTest);
    };
}
function fonctionTest(event) {
    console.log(event.currentTarget);
    event.currentTarget;
    let currentButton = event.currentTarget;
    currentButton.style.display = "none";
    event.currentTarget.nextElementSibling.style.display = "block";
    currentButton.style.color = "red";
    console.log('click');
}
clickTrashBtn();