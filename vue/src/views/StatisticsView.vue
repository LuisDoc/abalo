<template>
    <div class="bg-cgray">
        <div class="text-6xl headline ml-64 pt-20  text-purple">
            Statistiken
        </div>
        <div class="mt-20">
            <section>
                <div class="w-full xl:w-8/12  xl:mb-0  mx-auto mt-24 pb-20">
                    <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded ">
                        <div class="rounded-t mb-0 px-4 py-3 border-0">
                        <div class="flex flex-wrap items-center">
                            <div class="relative w-full px-4 max-w-full flex-grow flex-1">
                            <h3 class="font-semibold text-base text-blueGray-700">Page Visits</h3>
                            </div>
                        </div>
                        </div>

                        <div class="block w-full overflow-x-auto">
                            <table class="items-center bg-transparent w-full border-collapse ">
                                <thead>
                                <tr>
                                    <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                                Page name
                                                </th>
                                    <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                                    Visitors
                                                    </th>
                                    <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                                    Date
                                                    </th>
                                </tr>
                                </thead>

                                <tbody>
                                <tr v-for="stat in Object.keys(stats)" :key="stat">
                                    <th class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left text-blueGray-700 ">
                                    {{stat.split(":")[0]}}
                                    </th>
                                    <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 ">
                                        {{stats[stat]}}
                                    </td>
                                    <td class="border-t-0 px-6 align-center border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                    {{stat.split(":")[1]}}
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    </div>
                </section>
        </div>
    </div>
</template>

<script>
import { useToast } from "vue-toastification";
import axiosClient from '../axios'
export default {
    data(){
        return{
            stats: [],
        }
        
    },
    setup(){
        const toast = useToast();
        return {toast}
    },
    mounted(){
        fetch('http://localhost:8000/api/loadstatistics')
         .then(res => {
            let json = res.json();
            return json;
        }).then(data => {
            this.stats = data
        })
    }
    
}
</script>

<style>

</style>