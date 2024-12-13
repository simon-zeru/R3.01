const hello=()  => {console.log('Hello');};
const ok =  ()  => {console.log('Ok');   };
const bye = ()  => {console.log('Bye');  };

// const aCall = (callback) => {
//     const maxTime = 10000;
//     setTimeout(callback,  Math.random() * maxTime);
// };

// const aHello = () => { aCall(hello); };
// const aOk    = () => { aCall(ok);    };
// const aBye   = () => { aCall(bye);   };

// const main = () => {
//     aHello(); aOk(); aBye();
// };

// const aCall = (callback,then) => {
//     const maxTime = 10000;
//     setTimeout(() => {
//         callback(); 
//         if(then) { 
//             then(); 
//         } } , Math.random() * maxTime);
// };

// const aHello = () => { aCall(hello, aOk);  };
// const aOk    = () => { aCall(ok,    aBye); };
// const aBye   = () => { aCall(bye);         };

// const main = () => {
//     aHello();
// };


// const pCall = (callback) => {
//     return new Promise(
//         (resolve, reject) => {
//             const maxTime = 10000;
//             setTimeout(
//                 () => { callback(); resolve() },
//                  Math.random() * maxTime);
//         }
//     );
// };

// const pHello = () => { return pCall(hello); };
// const pOk =    () => { return pCall(ok);    };
// const pBye =   () => { return pCall(bye);   };

// const main = () => {
//     pHello().then(pOk).then(pBye);
// };

const pCall = (callback) => {
    return new Promise(
        (resolve, reject) => {
            const maxTime = 10000;
            setTimeout(
                () => { callback(); resolve() },
                Math.random() * maxTime);
        }
    );
};

const pHello = () => { return pCall(hello); };
const pOk =    () => { return pCall(ok);    };
const pBye =   () => { return pCall(bye);   };

const main = async () => {
    await pHello();
    await pOk();
    return pBye();
};

main();