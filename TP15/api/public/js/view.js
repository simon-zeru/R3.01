// Module de la vue 
// Les éléments DOM 
const nameInput = document.getElementsByTagName("input")[0]; // Nom en entrée
const nameOutput = document.getElementsByTagName("output")[0]; // Nom en sortie
const button = document.getElementsByTagName("button")[0];  // le boutton du formulaire
// 
const view = {
    // Lire le contenu de la vue
    read: function () {
        return nameInput.value; 
    },
    // Met à jour la vue
    update: function (out) {
        nameOutput.textContent = out;
    },
    // Accrocher une fonction callback à un événement click du bouton de la vue
    addEventListener: function (callback) { button.addEventListener("click", callback) }
}

export default view;