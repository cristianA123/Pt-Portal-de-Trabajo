
import { useAuthStore } from '@/stores/useAuthStore';
// import { storeToRefs } from 'pinia';

export const isAuthenticatedGuard = (to, from, next) => {

    const store = useAuthStore()

    const {isAuthenticated} = store

    if (isAuthenticated){
        next()
    } 
    else {
        next('/auth/login')
    }

}
