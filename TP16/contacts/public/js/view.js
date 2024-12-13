// La vue 
const input = document.querySelector("header input");       // La zone input du header
const tbody =  document.querySelector("main table tbody");  // La zone de sortie, juste le body de la table dans le main
const rowTemplate = document.querySelector("#rowTemplate");    // le template d'une ligne de la table

const view = {
    read: function () {
        return input.value.trim();
    },
    // Fonction qui affiche tous les contacts dans la table tbody
    update: function (contacts) {
        tbody.innerHTML = ''; // Efface les anciennes lignes
        contacts.forEach(contact => {
            const row = rowTemplate.content.cloneNode(true);
            row.querySelector('.prenom').textContent = contact.prenom;
            row.querySelector('.nom').textContent = contact.nom;
            row.querySelector('.mobile').textContent = contact.mobile;
            tbody.appendChild(row);
        });
    },

    //  
     // Accrocher une fonction callback à un événement click du bouton de la vue
     addEventListener: function (callback) {
        input.addEventListener('input', callback);
    }
};

export default view;