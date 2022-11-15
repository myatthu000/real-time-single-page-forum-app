class Token {

    isValid(token){
        const payload = this.payload(token);
        // console.log(payload)
        if (payload){
            return payload.iss === "http://127.0.0.1:8000/api/auth/login" || "http://127.0.0.1:8000/api/auth/signUp";
        }
        return false
    }

    payload(token){
        const payload = token.split(".")[1];
        return this.decode(payload);
    }


    decode(payload){
        if(this.isBase64(payload)){
            return JSON.parse(atob(payload))
        }
        return false;
    }

    isBase64(str){
        // console.log("aaa",str)
        // console.log("rrr",btoa(atob(str)))
        // console.log("dddd",btoa(atob(str)).replace(/==/g,"") == str)
        try{
            return btoa(atob(str)).replace(/==/g,"") == str;
        }
        catch(error){
            return false
        }
    }

    
}

export default Token = new Token()
