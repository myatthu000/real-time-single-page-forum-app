import axios from "axios";
import Token from "./Token";
import AppStorage from "./AppStorage";

class User {

    login(data) {
        console.log(data);
        axios.post("/api/auth/login",data)
            .then(response => {
                this.responseAfterLogin(response);
                window.location = "/forum"
                console.log(response.data)
                // Token.payload(response.data.access_token)
            })
            .catch(error => {
                this.errors = error.response.data.errors
                console.log("from login error",error.response.data)
            })
    }

    responseAfterLogin(response){

        const username = response.data.user;
        const access_token = response.data.access_token;
        console.log(access_token)
        console.log(username)
        if (Token.isValid(access_token)){
            AppStorage.store(username,access_token)
        }
    }

    hasToken(){
        const storedToken = AppStorage.getToken();
        if (storedToken){
            return Token.isValid(storedToken)
        }

        return false
    }

    loggedIn(){
        // window.location = '/forum'
        return this.hasToken();

    }

    logout(){
        AppStorage.clear();
        window.location = '/forum'
    }

    name(){
        if (this.loggedIn()){
            return AppStorage.getUser();
        }
    }

    id(){
        if (this.loggedIn()){
            const payload = Token.payload(AppStorage.getToken())
            return payload.sub;
        }
    }

    own(id){
        return this.id() == id;
    }

    admin(){
        return this.id() == 5;
    }
}


export default User = new User();
