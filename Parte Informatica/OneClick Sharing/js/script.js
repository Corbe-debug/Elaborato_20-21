function controllaSignup() {
    //Prendo i valori
    var nome = document.getElementById("Nome").value;
    var cognome = document.getElementById("Cognome").value;
    var dataNascita = document.getElementById("DataNascita").value;
    var indirizzo = document.getElementById("Indirizzo").value;
    var Email = document.getElementById("Email").value;
    var psw = document.getElementById("PSW").value;
    var confirmPSW = document.getElementById("ConfirmPSW").value;

    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

    //Controllo i campi
    if ((nome == "") || (nome == null)) {
        //Campo non corretto
        MessaggioErroreSignUp("Nome non inserito");
    } else if ((cognome == "") || (cognome == null)) {
        //Campo non corretto
        MessaggioErroreSignUp("Cognome non inserito");
        return false;
    } else if ((dataNascita == "") || (dataNascita == null)) {
        //Campo non corretto
        MessaggioErroreSignUp("Data di nascita non inserita");
        return false;
    } else if ((indirizzo == "") || (indirizzo == null)) {
        //Campo non corretto
        MessaggioErroreSignUp("Indirizzo non inserito");
        return false;
    } else if ((Email == "") || (Email == null)) {
        //Campo non corretto
        MessaggioErroreSignUp("Email non inserita");
        return false;
    } else if (!re.test(String(Email).toLowerCase())) {
        //Errore nel formato
        MessaggioErroreSignUp("Email non valida");
        return false;
    } else if ((psw == "") || (psw == null)) {
        //Campo non corretto
        MessaggioErroreSignUp("Password non inserita");
        return false;
    } else if ((confirmPSW == "") || (confirmPSW == null)) {
        //Campo non corretto
        MessaggioErroreSignUp("Password non inserita");
        return false;
    } else if (psw != confirmPSW) {
        //Password diverse
        MessaggioErroreSignUp("Password diverse");
        return false;
    }
}

//Messaggio di errore
function MessaggioErroreSignUp(temp) {
    window.alert(temp);
}