document
    .querySelector("input[name=isEmployee]")
    .addEventListener("click", function () {
        console.log("toggle");
        const tgtEl = document.querySelector(".employeeGroupSelection");
        tgtEl.classList.toggle("hidden");
    });

document
    .querySelector("select[name=employeeGroup]")
    .addEventListener("input", function (e) {
        let v = e.target.value;
        console.log(`change group to: ${v}`);

        if (v?.length) {
            document.querySelector("[name=user_groups]").value = v;
        }
    });
