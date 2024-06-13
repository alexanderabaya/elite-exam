const loader = document.getElementById("loader-container");
const loadertext = document.getElementById("loader-text");
window.addEventListener("load", () => {
  loader.addEventListener("transitionend", () => {
    loader.style.display = "none";
  });

  loader.classList.add("load--hidden");
});

function loadSubmitForm(button) {
  loader.classList.remove("load--hidden");
  loader.classList.add("load--submit");
  loadertext.textContent = "Submitting Request";
  loader.style.display = "flex";
  btn.form.submit();

}