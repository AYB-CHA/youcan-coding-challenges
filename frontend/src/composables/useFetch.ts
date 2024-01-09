import axios from '@/lib/axios'

import type { AxiosError } from 'axios';
import { ref, type Ref } from 'vue'

interface ResultType<T> {
    data: Ref<T | null>;
    isLoading: Ref<boolean>;
    error: Ref<AxiosError | null>;
    mutate: () => Promise<void>;
}

export function useFetch<T = any>(endpoint: string): ResultType<T> {
    const data = ref<any>(null);
    const isLoading = ref(false);
    const error = ref<AxiosError | null>(null);

    const mutate = async () => {
        try {
            isLoading.value = true;
            const response = await axios.get(endpoint);
            data.value = response.data;
        } catch (e) {
            error.value = (e as AxiosError);
            data.value = null;
        }
        finally {
            isLoading.value = false;
        }
    }

    mutate();

    return { data, isLoading, error, mutate };
}