<template>
    <div class="status-line">
        <div class="status-line__container">
            <div class="status-line__body">
                <div class="status-line__item" v-for="status in statuses">
                    <div class="status-line__status">
                        {{ status.status }}
                    </div>
                    <div class="status-line__line">
                        <div class="label">🚩</div>
                        <div :class="lineFilling(status.id)"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "TransactionStatusLine",
    props: ['statuses', 'currentStatus'],

    methods : {
        lineFilling(statusId) {
            if (statusId < this.currentStatus) return  'filled';
            if (statusId == this.currentStatus) return  'half-filled';
            if (statusId > this.currentStatus) return  'no-filled';
        }
    }
}
</script>

<style scoped>
.status-line {

}

.status-line__container {

}

.status-line__body {
    display: flex;
    padding: 15px 0;
}

.status-line__item {
    flex: 1 1 auto;
}

.status-line__status {
    font-size: 12px;
    color: #1a202c;
    text-shadow: none;
    text-align: center;
    padding-bottom: 15px;
}

.status-line__line {
    height: 30px;
    position:relative;
}
.label{
    position: absolute;
    top:0;
    left: 50%;
    transform: translate(-50%,0);
    color:white;
    font-size: 17px;
}
.filled{
    height: 100%;
    background-color: #38c172;
}
.half-filled{
    width: 50%;
    height:100%;
    background-color: #38c172;
}
.no-filled{
    background-color: #FFFFFF;
}
</style>
