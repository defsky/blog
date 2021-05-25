<template>
<div class="container">
    <el-checkbox v-model="tempVisible" @change="tempChange">温度监控</el-checkbox>
    <el-checkbox v-model="pmonVisible" @change="pmonChange">抛单监控</el-checkbox>
    <el-checkbox v-model="docVisible"  @change="docChange">单据监控</el-checkbox>
    <div v-if="tempVisible" class="row mb-2">
        <div class="col-md-12">
            <temperature />
        </div>
    </div>
    <div class="row mb-2">
        <div v-if="pmonVisible" :class="pmonClass">
            <appstatus />
        </div>
        <div v-if="docVisible" :class="docClass">
            <baddoc />
        </div>
    </div>
</div>
</template>

<script>
export default {
    data () {
        return {
            title:"Dashboard",
            tempVisible:true,
            pmonVisible:true,
            docVisible:true,
            pmonClass:"col-md-6",
            docClass:"col-md-6",
        }
    },
    methods:{
        tempChange:function(e){

        },
        pmonChange(checked){
            if(checked){
                this.pmonClass="col-md-6"
                this.docClass="col-md-6"
            }else{
                this.docClass="col-md-12"
            }
        },
        docChange(checked){
            if(checked){
                this.docClass="col-md-6"
                this.pmonClass="col-md-6"
            }else{
                this.pmonClass="col-md-12"
            }
        }
    }
}
</script>