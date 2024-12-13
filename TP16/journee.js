const seLaver = () => {
    const now = new Date().toLocaleString();
    console.log(now + " je me lave");
}

const manger = () => {
    const now = new Date().toLocaleString();
    console.log(now + " je mange");
}

const dormir = () => {
    const now = new Date().toLocaleString();
    console.log(now + " je dors");
}

const maJournee = (action1, action2, action3) => {
    console.log("Début de ma journée :")
    setTimeout(action1,Math.random() * 10000);
    setTimeout(action2,Math.random() * 10000);
    setTimeout(action3,Math.random() * 10000);
    
    console.log("Fin de ma journée.")
}

maJournee(dormir,seLaver,manger);