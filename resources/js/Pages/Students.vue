<script setup>
    import { ref, onMounted } from 'vue';
    import moment from 'moment';
    import Swal from 'sweetalert2/dist/sweetalert2.js'
    import 'sweetalert2/src/sweetalert2.scss'
    import Header from "../Components/Header.vue"

    const students = ref([]);
    let studentsCheck = ref([]);

    let date = ref(moment().format('YYYY-MM-DD'))

    const getData = async ()=>{
        const res = await fetch("/students");
        const finalRes = await res.json();
        students.value = finalRes.students;
    }

    const getAttendance = async() =>{
        const res = await fetch("/getAttendance/"+date.value);
        const finalRes = await res.json();
        studentsCheck.value = finalRes
    }

    onMounted( () => {
        getData();
        getAttendance()
    });

    const succesSwal = () => {
        Swal.fire({
            text: "Attendace is save!",
            icon: "success",
            buttonsStyling: false,
            confirmButtonText: "Ok",
        });
    }

    const errorSwal = (msg = null) => {
        Swal.fire({
            text: msg,
            icon: "error",
            buttonsStyling: false,
            confirmButtonText: "Ok"
        });
    }

    const props = defineProps(['headers'])

    const saveList = async ()=>{
        let data = {
            students:studentsCheck.value,
            date: moment().format('YYYY-MM-DD')
        }
        axios.post('/attendance', data).then(response =>{
            console.log(response)
                succesSwal(props.url)
            })
            .catch(function (error) {
                console.log(error)
                errorSwal()
            });
    }

    const checkLabel = (itemId)=>{
        const exists = studentsCheck.value.includes(itemId);

        if (exists) {
            studentsCheck.value = studentsCheck.value.filter((id) => id !== itemId);
        } else {
            studentsCheck.value.push(itemId);
        }

        console.log(studentsCheck.value)
        
    }
</script>

<template>
    <Header :saveList="saveList"/>
    
  <main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8 ">
        <div class="flex items-center justify-center">
            <div class="datepicker relative form-floating mb-3 xl:w-96">
                <input type="date"
                class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                placeholder="Select a date" v-model="date" @change="getAttendance()" />
            </div>
        </div>
        <div class="flex flex-col rounded-lg bg-white shadow-lg">
            <div class="p-6 flex flex-col justify-start">
                <table class="min-w-full">
                    <thead class="border-b">
                        <tr>
                            <th v-for="(item, index) in props.headers" :key="index" >
                                {{item.name}}  
                            </th>
                            <th class="min-w-100px text-left">Attendance</th>
                        </tr>
                    </thead>
                    <tbody>                        
                        <tr v-for="(item, index) in students" :key="index" class=" border-b text-center" >
                            <td v-for="(h, i) in headers" :key="i" class="text-sm text-gray-900 font-light px-4 py-4 whitespace-nowrap">
                                <a href="#" class="text-dark fw-bold text-hover-primary fs-6">{{ item[h.field] }}</a>
                            </td>
                            <td class="text-sm text-gray-900 font-light px-4 py-4 whitespace-nowrap">
                                <div class="form-check">
                                    <input class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" type="checkbox" :value="item.id" v-model="studentsCheck" @click="checkLabel(item.id)" >
                                    
                                </div>
                            </td>
                        </tr>    
                    </tbody>
                </table>
            </div>
        </div>
    </div>
  </main>

</template>
