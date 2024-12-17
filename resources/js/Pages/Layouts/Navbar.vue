<template>
    <div :style="{backgroundColor: $themeColor}" class="button-container col-lg-2 col-md-6 col-sm-11 col-11" style="position:fixed;bottom:10px;left:50%;transform: translate(-50%)">
        <button class="button">
            <svg fill="#000000" viewBox="0 0 24 24" id="timer-7-second" data-name="Flat Line" xmlns="http://www.w3.org/2000/svg" class="icon flat-line"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><circle id="secondary" cx="12" cy="13.5" r="7.5" style="fill: #2ca9bc; stroke-width: 2;"></circle><polyline id="primary" points="10.6 15.57 12 14 12 10" style="fill: none; stroke: #000000; stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;"></polyline><path id="primary-2" data-name="primary" d="M6.7,8.2,5.2,6.7M17.3,8.2l1.5-1.5M12,3V6m3-3H9m3,3a7.5,7.5,0,1,0,7.5,7.5A7.5,7.5,0,0,0,12,6Z" style="fill: none; stroke: #000000; stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;"></path></g></svg>
        </button>
        <button class="button">
            <svg class="icon" stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"
                height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z">
                </path>
            </svg>
        </button>
        <button class="button">
            <svg class="icon" stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24"
                height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M12 2.5a5.5 5.5 0 0 1 3.096 10.047 9.005 9.005 0 0 1 5.9 8.181.75.75 0 1 1-1.499.044 7.5 7.5 0 0 0-14.993 0 .75.75 0 0 1-1.5-.045 9.005 9.005 0 0 1 5.9-8.18A5.5 5.5 0 0 1 12 2.5ZM8 8a4 4 0 1 0 8 0 4 4 0 0 0-8 0Z">
                </path>
            </svg>
        </button>

        <button class="button">
            <svg class="icon" stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24"
                stroke-linecap="round" stroke-linejoin="round" height="1em" width="1em"
                xmlns="http://www.w3.org/2000/svg">
                <circle cx="9" cy="21" r="1"></circle>
                <circle cx="20" cy="21" r="1"></circle>
                <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
            </svg>
        </button>
    </div>

</template>

<script setup>


</script>

<style scoped>
.button-container {
    display: flex;
    align-items: center;
    height: 50px;
    justify-content: space-around;
    border-radius: 10px;
}

.button {
    outline: 0 !important;
    border: 0 !important;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background-color: transparent;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    transition: all ease-in-out 0.3s;
    cursor: pointer;
}

.button:hover {
    transform: translateY(-3px);
}

.icon {
    font-size: 20px;
}
</style>
