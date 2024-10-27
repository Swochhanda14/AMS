<div class="alertbox">`
    <span class="material-symbols-rounded alerticon">error</span>
    <h1>Your account will be deleted Permanently!</h1>
    <label>Are you sure to proceed?</label>
    <div class="btns">
        <a href="#" class="btn1">Cancel Process</a>
        <a href="#" class="btn2">Delete Account</a>
    </div>
</div>

<style>
    .alertbox{
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%) scale(1.2);
    border-radius: 5px;
    user-select: none;
    width: 500px;
    background-color: var(--neutral-100);
    display: flex;
    justify-content: center;
    text-align: center;
    align-items: center;
    flex-direction: column;
    padding: 40px 20px;
    border: 1px solid #b3b3b3;
    box-shadow: var(--shadow-1);
    z-index: 9999;
    opacity: 0;
    transition: top 0ms ease-in-out 200ms,
              opacity 200ms ease-in-out 0ms,
              transform 20ms ease-in-out 0ms ;
    pointer-events: none;

}

.alertbox .alerticon{
    font-size: 80px;
    color: var(--error-100);
    margin: -10px 0 20px 0;
}

.alertbox h1{
    font-size: 25px;
    color: var(--neutral-5);
    margin-block-end: 5px;
}
 
.alertbox label{
    font-size: 20px;
    color: var(--neutral-40);
}
 
.alertbox .btns{
    margin: 40px 0 0 0;
}

.btns .btn1 ,.btns .btn2{
    background-color: var(--neutral-40);
    color: var(--white);
    font-size: 16px;
    padding: 10px 13px;
    border: 1px solid var(--neutral-40);
    border-radius: 5px;
    text-decoration: none;
    transition: all .2s ease-in-out;
}

.btns .btn2{
    background-color: var(--error-100);
    margin-left: 20px;
    border: 1px soild var(--neutral-40);
}

.btns .btn1:hover{
    background-color: var(--neutral-20);
}

.btns .btn2:hover{
    background-color: #890505;
}

.addsuccesful{
    position: fixed;
    top: 0;
    left: 50%;
    transform: translate(-50%, -50%) scale(0.1);
    border-radius: 5px;
    user-select: none;
    width: 400px;
    background-color: var(--neutral-100);
    display: flex;
    justify-content: center;
    text-align: center;
    align-items: center;
    flex-direction: column;
    padding: 40px 20px;
    border: 1px solid #b3b3b3;
    box-shadow: var(--shadow-1);
    z-index: 9999;
    opacity: 0;
    transition: transform 0.4s, top 0.4s;
    pointer-events: auto;

}
.open-popup{
    top: 50%;
    opacity: 1;
    transform: translate(-50%, -50%) scale(1);
}

.addsuccesful img{
    width: 100px;
    border-radius: 50%;
    margin-top: -90px;
    margin-block-end: 10px;
    box-shadow: var(--shadow-1);
}

.addsuccesful h2{
    font-size: 35px;
    color: var(--neutral-5);
    margin-block-end: 5px;
}

.addsuccesful p{
    margin: 20px 20px 0px 20px;
    font-size: 15px;
    color: var(--neutral-40);
}

.addsuccesful .btns{
    margin: 30px 0 0 0;
    width: 100%;
    background-color: #6fd649;
    color: var(--white);
    font-size: 16px;
    padding: 10px 13px;
    outline: none;
    border: 0;
    border-radius: 5px;
    text-decoration: none;
    transition: all .2s ease-in-out;
    cursor: pointer;
    box-shadow: var(--shadow-2);
}

.addsuccesful .btns:hover{
    background-color: #57ac38;
}
</style>