window.addEventListener('load', ()=> {
    registerServiceWorker();
});

async function registerServiceWorker(){
    if('serviceWorker' in navigator){
        try{
            await navigator.serviceWorker.register('./serviceWorker.js')
        }catch(err){
            console.log('Service Worker registration failed!', err)
        }
    }
}