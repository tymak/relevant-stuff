import React, { useState, useEffect } from "react";

const UserReg = ({ apidata }) => {
    // list of states*****************
    const [isSmlouvaNaDobuUrcitou, setisSmlouvaNaDobuUrcitou] = useState(false);
    const [user_id, setUser_id] = useState(null);
    const [flat_id, setFlat_id] = useState(null);
    const [begining_of_first_rent, setBegining_of_first_rent] = useState(null);
    const [begining_of_current_rent, setBegining_of_current_rent] = useState(
        begining_of_first_rent
    );
    const [end_of_current_rent, SetEnd_of_current_rent] = useState(
        begining_of_first_rent
    );
    const [number_of_residents, SetNumber_of_residents] = useState(0);
    const [rental, setRental] = useState(0);

    const [contract_id, setContract_id] = useState(apidata.rentcontracts[0].id);
    const building_id = apidata.this_building.id;

    // ******************************-
    // nastaveni states

    const changeInput = e => {
        setContract_id(e.target.value);
        setisSmlouvaNaDobuUrcitou(!isSmlouvaNaDobuUrcitou);
    };
    const handleUser_id = e => {
        setUser_id(e.target.value);
    };
    const handleFlat_id = e => {
        setFlat_id(e.target.value);
    };
    const handleBegining_of_first_rent = e => {
        setBegining_of_first_rent(e.target.value);
        !begining_of_current_rent &&
            setBegining_of_current_rent(e.target.value);
    };
    const handleBegining_of_current_rent = e => {
        setBegining_of_current_rent(e.target.value);
    };
    const handleEnd_of_current_rent = e => {
        SetEnd_of_current_rent(e.target.value);
    };
    const handleNumber_of_residents = e => {
        SetNumber_of_residents(e.target.value);
    };
    const handleRental = e => {
        setRental(e.target.value);
    };

    // ***********************************************
    let _token = document.querySelector('meta[name="csrf-token"]').content;
    const handleSubmit = e => {
        e.preventDefault();
        let data = new FormData();
        data.append("_token", _token);
        data.append("user_id", user_id);
        data.append("flat_id", flat_id);
        data.append("contract_id", contract_id);
        data.append("building_id", building_id);
        data.append("begining_of_first_rent", begining_of_first_rent);
        data.append("begining_of_current_rent", begining_of_current_rent);
        data.append("end_of_current_rent", end_of_current_rent);
        data.append("number_of_residents", number_of_residents);
        data.append("rental", rental);

        let imagedata = document.querySelector('input[type="file"]').files[0];
        data.append("file", imagedata);
        console.log("data", data);
        fetch("/resident", {
            method: "post",
            // headers: {
            //     "Content-Type": "application/json"
            //     // 'Content-Type': 'application/x-www-form-urlencoded',
            // },
            body: data
        });
    };

    return (
        <>
            <div className="page__main__dash__item i__mid">
                <div className="page__main__dash__item__head">
                    <h3>Assign a Resident</h3>
                </div>
                <div className="page__main__dash__item__body">
                    <form
                        className="form__container"
                        encType="multipart/form-data"
                        onSubmit={handleSubmit}
                    >
                        <div className="form__item">
                            <label>Select user:</label>
                            <select
                                name="user_id"
                                onChange={handleUser_id}
                                value={user_id}
                            >
                                {apidata.users.map(user => {
                                    return (
                                        <option value={user.id}>
                                            {`${user.first_name}` +
                                                " " +
                                                `${user.last_name}`}
                                        </option>
                                    );
                                })}
                            </select>
                        </div>
                        <div className="form__item">
                            <label>Assign to flat:</label>
                            <select
                                name="flat_id"
                                onChange={handleFlat_id}
                                value={flat_id}
                            >
                                {apidata.flats.map(flat => {
                                    return (
                                        <option value={flat.id}>
                                            {`patro: ` +
                                                `${flat.floor}` +
                                                ` číslo bytu: ` +
                                                `${flat.number}`}
                                        </option>
                                    );
                                })}
                            </select>
                        </div>
                        {/* <input
                        type="hidden"
                        name="building_id"
                        value={apidata.this_building.id}
                    /> */}
                        <div className="form__item">
                            <label>First rental period started on:</label>
                            <input
                                type="date"
                                name="begining_of_first_rent"
                                onChange={handleBegining_of_first_rent}
                                value={begining_of_first_rent}
                            />
                        </div>
                        <div className="form__item">
                            <label>Current rental period started on:</label>
                            <input
                                type="date"
                                name="begining_of_current_rent"
                                onChange={handleBegining_of_current_rent}
                                value={begining_of_current_rent}
                            />
                        </div>
                        <div className="form__item">
                            <label>Contract Type: </label>
                            <select name="contract_id" onChange={changeInput}>
                                {apidata.rentcontracts.map(contract => {
                                    return (
                                        <option value={contract.id}>
                                            {`typ: ` + `${contract.name}`}
                                        </option>
                                    );
                                })}
                            </select>
                        </div>

                        {isSmlouvaNaDobuUrcitou && (
                            <>
                                <div className="form__item">
                                    <label>Contract End Date:</label>
                                    <input
                                        type="date"
                                        name="end_of_current_rent"
                                        onChange={handleEnd_of_current_rent}
                                        value={end_of_current_rent}
                                    />
                                </div>
                            </>
                        )}
                        <div className="form__item">
                            <label>People living in flat:</label>
                            <input
                                type="number"
                                name="number_of_residents"
                                onChange={handleNumber_of_residents}
                                value={number_of_residents}
                            />
                        </div>
                        <div className="form__item">
                            <label>Rent (CZK)</label>
                            <input
                                type="number"
                                name="rental"
                                onChange={handleRental}
                                value={rental}
                            />
                        </div>
                        <div className="form__item">
                            <label>Rental Agreement </label>
                            <input type="file" name="file" />
                        </div>
                        <div className="form__item">
                            <button className="form__submit" type="submit">
                                Assign
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </>
    );
};
export default UserReg;
