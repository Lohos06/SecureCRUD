document.addEventListener("DOMContentLoaded", function () {

    const form = document.getElementById("loginForm");
    const messageBox = document.getElementById("responseMessage");

    form.addEventListener("submit", function (e) {

        e.preventDefault();

        const formData = new FormData(form);

        fetch("Utils/TraitementConnection.php", {
            method: "POST",
            body: formData,
            headers: {
                "X-Requested-With": "XMLHttpRequest"
            }
        })
        .then(response => response.json())
        .then(data => {

            messageBox.innerText = "";

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

            } else if (data.status === "success") {

                messageBox.innerText = data.message;
                messageBox.style.color = "green";

                setTimeout(() => {
                    window.location.reload();
                }, 1000);
            }

        })
        .catch(() => {
            messageBox.innerText = "Erreur serveur.";
            messageBox.style.color = "red";
        });

    });

});
