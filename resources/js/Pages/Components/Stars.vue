<template>
    <div class="rating">
        <input type="radio" id="star5" name="rating" value="5" />
        <label for="star5"></label>
        <input type="radio" checked id="star4" name="rating" value="4" />
        <label for="star4"></label>
        <input type="radio" id="star3" name="rating" value="3" />
        <label for="star3"></label>
        <input type="radio" id="star2" name="rating" value="2" />
        <label for="star2"></label>
        <input type="radio" id="star1" name="rating" value="1" />
        <label for="star1"></label>
    </div>

</template>

<script setup>
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
