<template>

    <div class="rating">
        <template v-for="star in 5" :key="star">

      <input
        type="radio"
        :id="'star' + (6 - star)"
        name="rating"
        :value="6 - star"
        :checked="ratings === (6 - star)"
        disabled
      />
      <label :for="'star' + (6 - star)"></label>
    </template>
    </div>

</template>

<script setup>

const props = defineProps({
    ratings : {
        type : Number,
        required : true,
    }
})
</script>

<style scoped>
.rating {
  display: inline-block;
}

.rating input {
  display: none;
}

.rating label {
  float: right;
  cursor: pointer;
  transition: color 0.3s;
}

.rating label:before {
  content: "\2605";
  font-size: 30px;
}

.rating input:checked ~ label,
.rating label:hover,
.rating label:hover ~ label {
  color: #ffd700;
  transition: color 0.3s;
}

</style>
