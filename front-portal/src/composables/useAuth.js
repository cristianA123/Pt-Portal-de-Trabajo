import { apiClient } from "@/services/apiService"
import { useAuthStore } from "@/stores/useAuthStore"
import { storeToRefs } from "pinia"


export const useAuth = () => {

    const store = useAuthStore()

    const { isAuthenticated, user} = storeToRefs(store)
    const { login: loginStore, logout: logoutStore } = store

    const login = async (email, password) => {
        try {
            const { data } = await apiClient.post( '/login',{ 
                email,
                password
            });
    
            loginStore(data.data.user)
            return data

        } catch (error) {
            return {
                success: false,
                msg: 'Invalid credentials'
            }
        }
    }

    const register = async (payload) => {
        try {
            console.log(payload)
            const { data } = await apiClient.post( '/candidate',{ 
                ...payload
            });
    
            loginStore(data.data.user)
            return data

        } catch (error) {
            return {
                success: false,
                msg: 'Invalid credentials'
            }
        }
    }

    const logout = async () => {
        logoutStore()
    }

    return {
        login,
        register,
        isAuthenticated,
        user,
        logout
    }
}