<template>
    <div
        draggable="true"
        @mousedown="dragMouseDown"
        ref="draggableContainer"
        class="absolute text-3xl rounded-full bg-blue-500 w-20 h-20 flex justify-center items-center text-white"
    >
        <slot></slot>
    </div>
</template>
<script setup>
import { ref, inject } from "vue";

const { circle } = defineProps({
    circle: Object,
});
const emit = defineEmits(["mouseup"]);

const draggedCircleId = inject("draggedCircleId");

const draggableContainer = ref(null);
const positions = {
    clientX: undefined,
    clientY: undefined,
    movementX: 0,
    movementY: 0,
};

const dragMouseDown = (event) => {
    // console.log(event.dataTransfer);
    event.preventDefault();
    // get the mouse cursor position at startup:
    positions.clientX = event.clientX;
    positions.clientY = event.clientY;
    document.onmousemove = elementDrag;
    document.onmouseup = closeDragElement;
};

const elementDrag = (event) => {
    draggedCircleId.value = circle.id;
    // alert(event.dataTransfer);
    event.preventDefault();
    positions.movementX = positions.clientX - event.clientX;
    positions.movementY = positions.clientY - event.clientY;
    positions.clientX = event.clientX;
    positions.clientY = event.clientY;
    // set the element's new position:
    const draggableContainerDiv = draggableContainer.value;

    draggableContainerDiv.style.top =
        draggableContainerDiv.offsetTop - positions.movementY + "px";
    draggableContainerDiv.style.left =
        draggableContainerDiv.offsetLeft - positions.movementX + "px";
};

const closeDragElement = (event) => {
    draggedCircleId.value = null;
    document.onmouseup = null;
    document.onmousemove = null;
    emit("mouseup", { event, circle: draggableContainer.value });
};
</script>
<style scoped>
#draggable-container {
    position: absolute;
    z-index: 9;
}
#draggable-header {
    z-index: 10;
}
</style>
