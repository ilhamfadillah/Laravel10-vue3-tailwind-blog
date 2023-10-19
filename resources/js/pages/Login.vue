<template>
    <div class="grid grid-cols-3 h-full w-full">
        <div class="col-start-2 xs:col-span-3 bg-gradient-to-b from-gray-900 via-blue-900 to-violet-600 text-white">
            <div class="mt-[20px]">
                <h1 class="text-center">LOGIN</h1>
                <form @submit.prevent="handleSubmit" class="mt-[20px] text-[14px]">
                    <div class="flex flex-col w-3/4 mx-auto space-y-1">
                        <label for="email">Email</label>
                        <input type="email" class="py-1 px-2 text-black" placeholder="Email" v-model="email">
                        <p v-if="v$.email.$error" class="italic text-[12px] text-rose-500">
                            {{ v$.email.$errors[0].$message }}
                        </p>
                    </div>
                    <div class="flex flex-col w-3/4 mx-auto space-y-1">
                        <label for="password">Password</label>
                        <input type="password" class="py-1 px-2 text-black" placeholder="Email" v-model="password">
                        <p v-if="v$.password.$error" class="italic text-[12px] text-rose-500">
                            {{ v$.password.$errors[0].$message }}
                        </p>
                    </div>
                    <div class="flex flex-col w-3/4 mx-auto space-y-1 mt-3">
                        <button type="submit" class="bg-gray-200 p-1 text-black rounded-md">Submit</button>
                        <div class="flex justify-between underline pt-1">
                            <div>Registration</div>
                            <div>Forgot Password</div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
import { useVuelidate } from "@vuelidate/core";
import { required, email } from "@vuelidate/validators";

export default {
    data() {
        return {
            v$: useVuelidate(),
            email: '',
            password: ''
        }
    },
    validations() {
        return {
            email: { required, email },
            password: { required }
        }
    },
    methods: {
        handleSubmit() {
            this.v$.$validate();
            if (this.v$.$error) {
                return;
            } else {
                axios.post("/api/login", {
                    email: this.email,
                    password: this.password
                }).then((response) => {
                    const data = response.data.data;
                    localStorage.setItem("token", data.access_token);
                    localStorage.setItem("user", data.user);
                    this.$router.push({ name: 'adminDashboard' });
                })
            }
        }
    },
    beforeCreate() {
        if (localStorage.getItem('token')) {
            this.$router.push({ name: 'adminDashboard' });
        }
    },
}

</script>