
const salutation = (name) => { alert("Bonjour " + name); }

const processUserInput = (callback) => {
    const name = prompt("Entrez votre nom.");

    const newCallback = () => {callback(name)}; // Nouvelle fonction qui appelle la callback avec son paramètre

    setTimeout(newCallback,2000); // Appel de la callback de la callback
}

processUserInput(salutation);