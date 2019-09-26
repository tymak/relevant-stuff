import React, { useState, useEffect } from "react";

const BuildingReg = ({ data, refetchApp }) => {
    const [buildingData, setbuidlingData] = useState(data);
    return (
        <>
            <div className="page__main__dash__item i__mid">
                <div className="page__main__dash__item__head">
                    <h3>Edit building info</h3>
                </div>
                <div className="page__main__dash__item__body">
                    <form
                        className="form__container"
                        encType="multipart/form-data"
                        onSubmit={e => {
                            e.preventDefault();
                            const data = new FormData(e.target);
                            const fetchURL =
                                "/su/edit/building/" + buildingData.id;
                            fetch(fetchURL, {
                                method: "post",
                                body: data
                            }).then(() => {
                                refetchApp();
                                alert("Updated");
                            });
                        }}
                    >
                        <div className="form__item">
                            <label>City:</label>
                            <input
                                type="text"
                                name="city"
                                id="name"
                                defaultValue={buildingData.city}
                            />
                        </div>
                        <div className="form__item">
                            <label>Street:</label>
                            <input
                                type="text"
                                name="street"
                                id="street"
                                defaultValue={buildingData.street}
                            />
                        </div>
                        <div className="form__item">
                            <label>House number:</label>
                            <input
                                type="number"
                                name="house_number"
                                id="house_number"
                                defaultValue={buildingData.house_number}
                            />
                        </div>
                        <div className="form__item">
                            <label>Post Code:</label>
                            <input
                                type="number"
                                name="postal"
                                id="postal"
                                defaultValue={buildingData.postal}
                            />
                        </div>
                        <div className="form__item">
                            <label>Construction completed:</label>
                            <input
                                type="date"
                                name="construction_date"
                                defaultValue={buildingData.construction_date}
                            />
                        </div>
                        <div className="form__item">
                            <label>Floors above the ground lvl:</label>
                            <input
                                type="number"
                                name="floors_above_ground"
                                defaultValue={buildingData.floors_above_ground}
                            />
                        </div>
                        <div className="form__item">
                            <label>Floors below the ground lvl:</label>
                            <input
                                type="number"
                                name="floors_bellow_ground"
                                defaultValue={buildingData.floors_bellow_ground}
                            />
                        </div>
                        <div className="form__item">
                            <label>Heating</label>
                            <input
                                type="checkbox"
                                name="heating"
                                value="1"
                                defaultChecked={
                                    buildingData.heating == 1 && true
                                }
                            />
                        </div>
                        <div className="form__item">
                            <label>Gas</label>
                            <input
                                type="checkbox"
                                name="gas"
                                value="1"
                                defaultChecked={buildingData.gas == 1 && true}
                            />
                        </div>
                        <div className="form__item">
                            <label>Elevator(s)</label>
                            <input
                                type="number"
                                name="elevator"
                                defaultValue={buildingData.elevator}
                            />
                        </div>
                        <input
                            type="hidden"
                            name="_token"
                            value={
                                document.querySelector(
                                    'meta[name="csrf-token"]'
                                ).content
                            }
                        />

                        <button type="submit" className="form__submit">
                            Edit
                        </button>
                    </form>
                    <br />
                </div>
            </div>
        </>
    );
};
export default BuildingReg;
