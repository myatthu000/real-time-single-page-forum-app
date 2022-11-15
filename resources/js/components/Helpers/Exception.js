import User from './User';

class Exception{

    handle(error){
        this.isExpired(error.response.data.error);
    }

    isExpired(error){
        console.log("exp",error)
        if(error == 'Token is Expired, Get new One'){
            User.logout()
        }
    }
}



export default Exception = new Exception();