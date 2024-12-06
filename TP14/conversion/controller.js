//////////////// Partie Contrôleur /////////////////
// On a besoin de la vue et du modèle
import {view} from "./view.js";
import {model} from "./model.js";


// Gestionnaire d'évènement
function onCalculer() {
  // Récupération de la valeur en entrée
  let input = view.read();
  if (isNaN(input)) {
    view.update("X");
  } else {
    // Réalisation du calcul par le modèle
    let output = model.compute(input);
    // Sortie du résultat sur la vue
    view.update(output);
  }

}

// Initialisation pour afficher 'X' au démarrage
function init() {
    view.update("X");
}

// Attache le gestionnaire d'évenement à la vue
view.addEventListener(onCalculer);

// Initialisation au démarrage
init();