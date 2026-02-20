
document.addEventListener("DOMContentLoaded", function () {

    const form = document.getElementById("registerForm");
    const messageBox = document.getElementById("messageBox");

    form.addEventListener("submit", function (e) {

        e.preventDefault(); // pas de refresh

        const formData = new FormData(form);

        fetch("Utils/traitementInscription.php", {
            method: "POST",
            body: formData,
            headers: {
                "X-Requested-With": "XMLHttpRequest"
            }
        })
        .then(response => response.json())
        .then(data => {

            messageBox.innerText = ""; /*tab d'error*/

            if (data.status === "error") {

                let messages = "";

                if (data.errors) {
                    for (let field in data.errors) {
                        messages += data.errors[field] + "\n";
                    }
                } else if (data.message) {
                    messages = data.message;
                }

                messageBox.innerText = messages;
                messageBox.style.color = "red";

            } if (data.status === "success") {

                messageBox.innerText = data.message;
                messageBox.style.color = "green";

                setTimeout(() => {
                    window.location.href = data.redirect;
                }, 1000);
            

                // mise à jour token
                if (data.newToken) {
                    form.querySelector("input[name='token']").value = data.newToken;
                }
            }

        })
        .catch(() => {
            messageBox.innerText = "Erreur serveur.";
            messageBox.style.color = "red";
        });

    });

});