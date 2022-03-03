<script type="text/javascript">
    import datepicker from 'vuejs-datepicker';
    import moment from 'moment';
    export default{
        data() {
            return{
                time:'',
                doctors:[]
            }
        }, 
        components:{ 
            datepicker
        },
        methods:{
            customDate(date){
                this.time = moment(date).format('YYYY-MM-DD');
                
            }
        },
        mounted(){
            axios
                .get('api/doctors/today')
                .then((res)=>{this.doctors = res.data})
        }
    }
</script>
<template>
    <div>
        <div class="card">
            <div class="card-header">Find Doctors</div>
                <div class="card-body">
                       <div>
                           <datepicker :format="customDate" v-model="time" :inline= true></datepicker>
                       </div>
                </div>
        <div class="card">
            <div class="card-header">Doctors</div>
                <div class="card-body">
                       <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Photo</th>
                                    <th>Name</th>
                                    <th>Expertise</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>          

                       </table>
                </div>
                </div>
        </div>
    </div>
</template>


