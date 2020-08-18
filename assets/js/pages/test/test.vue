<template>
    <div>
    <h1>This is a text for testing purposes</h1>
    <img :src="require('../../../img/counts-img.jpg')" alt="image not found">

    yup exactly
    </div>
</template>


<script>
    import image from "../../../img/counts-img.jpg" ;

export default({
        name: 'Test',
        data(){
            return {
                'image' : image
            }
        }
    })
</script>