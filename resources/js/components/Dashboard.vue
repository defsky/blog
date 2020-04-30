<template>
<div class="container">
    <div class="row mb-2">
        <div class="col-md-12">
            <temperature />
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-md-6">
            <appstatus />
        </div>
    </div>
</div>
</template>

<script>
export default {
    data () {
        return {
            title:"Dashboard"
        }
    }
}
</script>