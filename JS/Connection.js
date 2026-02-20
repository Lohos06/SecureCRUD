
document.getElementById("loginForm")?.addEventListener("submit", function(e) {
    e.preventDefault();

    const formData = new FormData(this);

    fetch("Utils/TraitementConnection.php", { /*connexion au connexion traitement*/
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        const messageDiv = document.getElementById("responseMessage");

        if (data.status === "success") {/*si on est bien co message vert */
            messageDiv.innerHTML = "<p style='color:green'>" + data.message + "</p>";
            setTimeout(() => {
                window.location.reload();
            }, 1000);
        } else {
            messageDiv.innerHTML = "<p style='color:red'>" + data.errors.join("<br>") + "</p>";
        }
    });
});