import axios from "axios"

export  function getToken()
{
    return window.csrf_token ;
}

export function authentication(form)
{

    const data =new FormData(form) ;
   return  axios({
       method: 'post',
       url: '/login',
       data: data,
       headers: {'Content-Type': 'multipart/form-data' }
   })
/*     ,
     ,
    '_csrf_token' : token ,
    'ajax' : true*/
 /*      ,{headers: {    'content-type': 'application/json' ,
           'X-Requested-With':'XMLHttpRequest' }}*/
}