import axios from '@/lib/axios'

import type { AxiosError } from 'axios';
import { ref, type Ref } from 'vue'

type ParamsType = Record<string, string | undefined>;

interface ResultType<T> {
    data: Ref<T | null>;
    isLoading: Ref<boolean>;
    error: Ref<AxiosError | null>;
    mutate: (params: ParamsType) => Promise<void>;
}

export function useFetch<T = any>(endpoint: string, params: ParamsType = {}): ResultType<T> {
    const data = ref<any>(null);
    const isLoading = ref(false);
    const error = ref<AxiosError | null>(null);

    const mutate = async (params: ParamsType = {}) => {
        try {
            isLoading.value = true;
            const response = await axios.get(endpoint, {
                params,
            });
            data.value = response.data;
        } catch (e) {
            error.value = (e as AxiosError);
            data.value = null;
        }
        finally {
            isLoading.value = false;
        }
    }

    mutate(params);

    return { data, isLoading, error, mutate };
}