import { apiClient } from "@/services/apiService"
import { useAuthStore } from "@/stores/useAuthStore";
import { storeToRefs } from "pinia";



export const usePortal = () => {

    const store = useAuthStore()

    const { user} = storeToRefs(store)
    // const { login: loginStore, logout: logoutStore } = store

    const getJobs = async () => {
        try {
            const { data } = await apiClient.get( '/jobs');
    
            return data

        } catch (error) {
            return {
                success: false,
                msg: 'Invalid credentials'
            }
        }
    }

    const getCandidates = async (email, password) => {
        try {
            const { data } = await apiClient.post( '/login',{ 
                email,
                password
            });
    
            return data

        } catch (error) {
            return {
                success: false,
                msg: 'Invalid credentials'
            }
        }
    }

    const createJob = async (payload) => {
        try {
            const { data } = await apiClient.post( '/job',{ 
                ...payload
            });
    
            return data

        } catch (error) {
            return {
                success: false,
                msg: 'Invalid credentials'
            }
        }
    }

    const getDetailJob = async (payload) => {
        try {
            const { data } = await apiClient.post( '/detailJob',{ 
                ...payload
            });
    
            return data

        } catch (error) {
            return {
                success: false,
                msg: 'Invalid credentials'
            }
        }
    }

    const applyJob = async (payload) => {
  
        try {
            const { data } = await apiClient.post( '/apply',{ 
                candidate_id: user.value.id,
                ...payload,
            });
    
            return data

        } catch (error) {
            return {
                success: false,
                msg: 'Invalid credentials'
            }
        }
    }

    const myApplyJob = async () => {
  
        try {
            const { data } = await apiClient.post( '/my-applications',{ 
                candidate_id: user.value.id,
            });
    
            return data

        } catch (error) {
            return {
                success: false,
                msg: 'Invalid credentials'
            }
        }
    }


    return {
        getJobs,
        getCandidates,
        createJob,
        getDetailJob,
        applyJob,
        myApplyJob
    }
}