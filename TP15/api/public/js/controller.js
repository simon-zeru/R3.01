//////////////// Module contrôleur ///////////////// 
// On a besoin de la vue et du modèle
import view from "./view.js";
import model from "./model.js";

// Callback pour la réaction du modèle
function onAnswser(text) {
    view.update(text);
}

// Callback pour la réaction au click
function onSaluer() {
    const name = view.read();
    model.saluer(name, onAnswser);
}

// Attache le controleur au bouton
view.addEventListener(onSaluer);