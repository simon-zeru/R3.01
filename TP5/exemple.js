let number;
do {
    number = prompt("Entrer un nombre");
    if (isNaN(number)) {
        console.log("Votre entrée doit être un nombre, recommencez...")
    }
} while (isNaN(number));

console.log("Voici la table de ", number);
for (let i = 1; i < 11; i++) {
    console.log(i, "x",number,"=", i*number);
}