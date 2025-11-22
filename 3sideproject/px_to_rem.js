const html = `
<div style="width: 100%; background: white; flex-direction: column; justify-content: space-between; align-items: center; display: inline-flex">
    <div style="align-self: stretch; padding-left: 16px; padding-right: 16px; padding-top: 30px; padding-bottom: 30px; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 30px; display: flex">
        <div style="align-self: stretch; justify-content: flex-start; align-items: center; gap: 8px; display: inline-flex">
            <div style="width: 20px; height: 20px; background: #D9D9D9"></div>
            <div style="width: 8.71px; height: 15.80px; background: black"></div>
            <div style="text-align: center; justify-content: center; display: flex; flex-direction: column; color: black; font-size: 20px; font-family: Pretendard Variable; font-weight: 600; word-wrap: break-word">팀원 찾기</div>
        </div>
        <div style="align-self: stretch; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 14px; display: flex">
            <div style="align-self: stretch; height: 54px; padding-left: 16px; padding-right: 16px; padding-top: 10px; padding-bottom: 10px; background: white; box-shadow: 0px 0px 2px rgba(0, 0, 0, 0.05); border-radius: 12px; outline: 1px #E5E5EC solid; outline-offset: -1px; justify-content: flex-start; align-items: center; gap: 10px; display: inline-flex">
                <div style="width: 18px; height: 18px; position: relative; overflow: hidden">
                    <div style="width: 12px; height: 12px; left: 2.25px; top: 2.25px; position: absolute; outline: 2px #767676 solid; outline-offset: -1px"></div>
                    <div style="width: 3.26px; height: 3.26px; left: 12.49px; top: 12.49px; position: absolute; outline: 2px #767676 solid; outline-offset: -1px"></div>
                </div>
                <div style="color: #767676; font-size: 16px; font-family: Pretendard Variable; font-weight: 400; text-transform: uppercase; line-height: 20.80px; word-wrap: break-word">아이디, 이름, 전화번호 검색</div>
            </div>
            <div style="align-self: stretch; height: 40px; padding: 2px; background: #F1F1F1; border-radius: 8px; justify-content: flex-start; align-items: center; gap: 22px; display: inline-flex">
                <div style="flex: 1 1 0; height: 36px; padding-left: 24px; padding-right: 24px; padding-top: 6px; padding-bottom: 6px; background: white; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.08); border-radius: 8px; justify-content: center; align-items: center; gap: 10px; display: flex">
                    <div style="justify-content: flex-start; align-items: center; gap: 2px; display: flex">
                        <div style="color: #8F8F8F; font-size: 14px; font-family: Pretendard; font-weight: 400; line-height: 20px; word-wrap: break-word">Hacker</div>
                    </div>
                </div>
                <div style="flex: 1 1 0; height: 28px; padding-left: 24px; padding-right: 24px; padding-top: 6px; padding-bottom: 6px; border-radius: 999px; justify-content: center; align-items: center; gap: 10px; display: flex">
                    <div style="justify-content: flex-start; align-items: center; gap: 2px; display: flex">
                        <div style="color: #8F8F8F; font-size: 14px; font-family: Pretendard; font-weight: 400; line-height: 20px; word-wrap: break-word">Hipster</div>
                    </div>
                </div>
                <div style="flex: 1 1 0; height: 28px; padding-left: 24px; padding-right: 24px; padding-top: 6px; padding-bottom: 6px; border-radius: 999px; justify-content: center; align-items: center; gap: 10px; display: flex">
                    <div style="justify-content: flex-start; align-items: center; gap: 2px; display: flex">
                        <div style="color: #8F8F8F; font-size: 14px; font-family: Pretendard; font-weight: 400; line-height: 20px; word-wrap: break-word">Hustler</div>
                    </div>
                </div>
            </div>
            <div style="align-self: stretch; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 10px; display: flex">
                <div style="align-self: stretch; justify-content: space-between; align-items: center; display: inline-flex; flex-wrap: wrap; align-content: center">
                    <div style="justify-content: flex-start; align-items: center; gap: 10px; display: flex">
                        <div style="padding-left: 16px; padding-right: 16px; padding-top: 10px; padding-bottom: 10px; background: white; border-radius: 100px; outline: 1px #E5E5EC solid; outline-offset: -1px; justify-content: center; align-items: center; gap: 4px; display: flex">
                            <div style="color: #767676; font-size: 16px; font-family: Pretendard Variable; font-weight: 500; text-transform: uppercase; line-height: 20.80px; word-wrap: break-word">전체</div>
                        </div>
                        <div style="width: 1px; align-self: stretch; background: var(--Line-Normal-Normal, rgba(112, 115, 124, 0.22))"></div>
                        <div style="width: 212px; overflow: hidden; justify-content: flex-start; align-items: center; gap: 10px; display: flex">
                            <div style="padding-top: 10px; padding-bottom: 10px; padding-left: 16px; padding-right: 8px; background: white; border-radius: 100px; outline: 1px #E5E5EC solid; outline-offset: -1px; justify-content: center; align-items: center; gap: 2px; display: flex">
                                <div style="color: #767676; font-size: 16px; font-family: Pretendard Variable; font-weight: 500; text-transform: uppercase; line-height: 20.80px; word-wrap: break-word">관심 도메인</div>
                                <div style="width: 20px; height: 20px; position: relative; transform: rotate(90deg); transform-origin: top left; overflow: hidden">
                                    <div style="width: 10px; height: 5px; left: 5px; top: 7.50px; position: absolute; outline: 1.50px #767676 solid; outline-offset: -0.75px"></div>
                                </div>
                            </div>
                            <div style="padding-top: 10px; padding-bottom: 10px; padding-left: 16px; padding-right: 8px; background: white; border-radius: 100px; outline: 1px #E5E5EC solid; outline-offset: -1px; justify-content: center; align-items: center; gap: 2px; display: flex">
                                <div style="color: #767676; font-size: 16px; font-family: Pretendard Variable; font-weight: 500; text-transform: uppercase; line-height: 20.80px; word-wrap: break-word">목적</div>
                                <div style="width: 20px; height: 20px; position: relative; transform: rotate(90deg); transform-origin: top left; overflow: hidden">
                                    <div style="width: 10px; height: 5px; left: 5px; top: 7.50px; position: absolute; outline: 1.50px #767676 solid; outline-offset: -0.75px"></div>
                                </div>
                            </div>
                            <div style="padding-top: 10px; padding-bottom: 10px; padding-left: 16px; padding-right: 8px; background: white; border-radius: 100px; outline: 1px #E5E5EC solid; outline-offset: -1px; justify-content: center; align-items: center; gap: 2px; display: flex">
                                <div style="color: #767676; font-size: 16px; font-family: Pretendard Variable; font-weight: 500; text-transform: uppercase; line-height: 20.80px; word-wrap: break-word">사용하는 툴</div>
                                <div style="width: 20px; height: 20px; position: relative; transform: rotate(90deg); transform-origin: top left; overflow: hidden">
                                    <div style="width: 10px; height: 5px; left: 5px; top: 7.50px; position: absolute; outline: 1.50px #767676 solid; outline-offset: -0.75px"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="width: 24px; height: 24px; position: relative; overflow: hidden">
                        <div style="width: 18.60px; height: 18px; left: 3px; top: 3px; position: absolute; background: #767676"></div>
                    </div>
                </div>
            </div>
        </div>
        <div style="align-self: stretch; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 10px; display: flex">
            <div style="align-self: stretch; height: 117px; padding-left: 11px; padding-right: 11px; padding-top: 16px; padding-bottom: 16px; background: var(--Gradient, white); box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.08); overflow: hidden; border-radius: 12px; outline: 1px #CBD5E1 solid; outline-offset: -1px; justify-content: center; align-items: center; display: inline-flex">
                <div style="flex: 1 1 0; flex-direction: column; justify-content: center; align-items: flex-start; gap: 14px; display: inline-flex">
                    <div style="align-self: stretch; justify-content: space-between; align-items: flex-start; display: inline-flex">
                        <div style="width: 174px; justify-content: flex-start; align-items: flex-start; gap: 12px; display: flex">
                            <img style="width: 42px; height: 42px; padding: 10px; border-radius: 99px" src="https://placehold.co/42x42" />
                            <div style="width: 160px; align-self: stretch; flex-direction: column; justify-content: center; align-items: flex-start; gap: 12px; display: inline-flex">
                                <div style="align-self: stretch; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 4px; display: flex">
                                    <div style="align-self: stretch; justify-content: flex-start; align-items: center; gap: 12px; display: inline-flex">
                                        <div style="justify-content: center; display: flex; flex-direction: column; color: #16181C; font-size: 14px; font-family: Pretendard Variable; font-weight: 600; word-wrap: break-word">박나영</div>
                                        <div style="justify-content: center; display: flex; flex-direction: column; color: var(--Neutral-Color-6, #757575); font-size: 10px; font-family: Pretendard Variable; font-weight: 400; word-wrap: break-word">매주 토요일 가능</div>
                                    </div>
                                    <div style="align-self: stretch; justify-content: flex-start; align-items: center; gap: 4px; display: inline-flex">
                                        <div style="justify-content: center; display: flex; flex-direction: column; color: #475569; font-size: 12px; font-family: Pretendard Variable; font-weight: 400; word-wrap: break-word">Figma</div>
                                        <div style="justify-content: center; display: flex; flex-direction: column; color: #475569; font-size: 15px; font-family: Pretendard Variable; font-weight: 400; word-wrap: break-word">·</div>
                                        <div style="justify-content: center; display: flex; flex-direction: column; color: #475569; font-size: 12px; font-family: Pretendard Variable; font-weight: 400; word-wrap: break-word">HTML</div>
                                        <div style="justify-content: center; display: flex; flex-direction: column; color: #475569; font-size: 15px; font-family: Pretendard Variable; font-weight: 400; word-wrap: break-word">·</div>
                                        <div style="justify-content: center; display: flex; flex-direction: column; color: #475569; font-size: 12px; font-family: Pretendard Variable; font-weight: 400; word-wrap: break-word">Notion</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="height: 20px; justify-content: center; align-items: center; display: flex">
                            <div data-active="False" style="align-self: stretch; position: relative; flex-direction: column; justify-content: center; align-items: center; display: inline-flex">
                                <div style="flex: 1 1 0; position: relative; justify-content: center; align-items: center; display: inline-flex">
                                    <div style="align-self: stretch; flex-direction: column; justify-content: center; align-items: center; display: inline-flex">
                                        <div data-fill="False" data-name="bookmark" style="flex: 1 1 0; position: relative; flex-direction: column; justify-content: center; align-items: center; display: flex">
                                            <div style="width: 20px; height: 20px; left: 0px; top: 0px; position: absolute">
                                                <div style="width: 13.17px; height: 16.50px; left: 3.42px; top: 2.17px; position: absolute; background: var(--Label-Normal, #171719); border: 1px var(--Label-Normal, #171719) solid"></div>
                                            </div>
                                            <div data-ratio="1:1" style="flex: 1 1 0; overflow: hidden; flex-direction: column; justify-content: flex-start; align-items: flex-start; display: flex">
                                                <div style="flex: 1 1 0; transform: rotate(-37deg); transform-origin: top left; flex-direction: column; justify-content: center; align-items: center; display: flex"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="width: 20px; height: 20px; left: 0px; top: 0px; position: absolute; background: #475569"></div>
                                </div>
                                <div style="width: 28px; height: 28px; left: -4px; top: -4px; position: absolute; opacity: 0.50">
                                    <div data-state="Normal" style="width: 28px; height: 28px; left: 0px; top: 0px; position: absolute; opacity: 0; background: var(--Label-Normal, #171719); border-radius: 1000px"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="align-self: stretch; height: 25px; justify-content: flex-start; align-items: center; gap: 9px; display: inline-flex">
                        <div data-property-1="원형-S-none" style="width: 156px; height: 32px; padding: 16px; background: #F8F8F8; overflow: hidden; border-radius: 99px; outline: 1px var(--Neutral-Color-3, #C1C1C1) solid; outline-offset: -1px; justify-content: center; align-items: center; gap: 4px; display: flex">
                            <div style="color: var(--Neutral-Color-6, #757575); font-size: 12px; font-family: Pretendard; font-weight: 600; line-height: 18px; word-wrap: break-word">채팅하기</div>
                        </div>
                        <div data-property-1="원형-S-Default" style="width: 156px; height: 32px; padding: 16px; background: var(--tishoo-Cyan, #1E78FF); overflow: hidden; border-radius: 99px; justify-content: center; align-items: center; gap: 4px; display: flex">
                            <div style="color: var(--Static-White, white); font-size: 12px; font-family: Pretendard; font-weight: 600; line-height: 18px; word-wrap: break-word">제안하기</div>
                        </div>
                    </div>
                </div>
            </div>
            <div style="align-self: stretch; height: 117px; padding-left: 11px; padding-right: 11px; padding-top: 16px; padding-bottom: 16px; background: var(--Gradient, white); box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.08); overflow: hidden; border-radius: 12px; outline: 1px #CBD5E1 solid; outline-offset: -1px; justify-content: center; align-items: center; display: inline-flex">
                <div style="flex: 1 1 0; flex-direction: column; justify-content: center; align-items: flex-start; gap: 14px; display: inline-flex">
                    <div style="align-self: stretch; justify-content: space-between; align-items: flex-start; display: inline-flex">
                        <div style="width: 174px; justify-content: flex-start; align-items: flex-start; gap: 12px; display: flex">
                            <img style="width: 42px; height: 42px; padding: 10px; background: var(--Neutral-Color-2, #DBDBDB); border-radius: 99px" src="https://placehold.co/42x42" />
                            <div style="width: 160px; align-self: stretch; flex-direction: column; justify-content: center; align-items: flex-start; gap: 12px; display: inline-flex">
                                <div style="align-self: stretch; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 4px; display: flex">
                                    <div style="align-self: stretch; justify-content: flex-start; align-items: center; gap: 12px; display: inline-flex">
                                        <div style="justify-content: center; display: flex; flex-direction: column; color: #16181C; font-size: 14px; font-family: Pretendard Variable; font-weight: 600; word-wrap: break-word">장범준</div>
                                        <div style="justify-content: center; display: flex; flex-direction: column; color: var(--Neutral-Color-6, #757575); font-size: 10px; font-family: Pretendard Variable; font-weight: 400; word-wrap: break-word">매주 금요일 가능</div>
                                    </div>
                                    <div style="align-self: stretch; justify-content: flex-start; align-items: center; gap: 4px; display: inline-flex">
                                        <div style="justify-content: center; display: flex; flex-direction: column; color: #475569; font-size: 12px; font-family: Pretendard Variable; font-weight: 400; word-wrap: break-word">Jira</div>
                                        <div style="justify-content: center; display: flex; flex-direction: column; color: #475569; font-size: 15px; font-family: Pretendard Variable; font-weight: 400; word-wrap: break-word">·</div>
                                        <div style="justify-content: center; display: flex; flex-direction: column; color: #475569; font-size: 12px; font-family: Pretendard Variable; font-weight: 400; word-wrap: break-word">Discord</div>
                                        <div style="justify-content: center; display: flex; flex-direction: column; color: #475569; font-size: 15px; font-family: Pretendard Variable; font-weight: 400; word-wrap: break-word">·</div>
                                        <div style="justify-content: center; display: flex; flex-direction: column; color: #475569; font-size: 12px; font-family: Pretendard Variable; font-weight: 400; word-wrap: break-word">Github</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="height: 20px; justify-content: center; align-items: center; display: flex">
                            <div data-active="False" style="align-self: stretch; position: relative; flex-direction: column; justify-content: center; align-items: center; display: inline-flex">
                                <div style="flex: 1 1 0; position: relative; justify-content: center; align-items: center; display: inline-flex">
                                    <div style="align-self: stretch; flex-direction: column; justify-content: center; align-items: center; display: inline-flex">
                                        <div data-fill="False" data-name="bookmark" style="flex: 1 1 0; position: relative; flex-direction: column; justify-content: center; align-items: center; display: flex">
                                            <div style="width: 20px; height: 20px; left: 0px; top: 0px; position: absolute">
                                                <div style="width: 13.17px; height: 16.50px; left: 3.42px; top: 2.17px; position: absolute; background: var(--Label-Normal, #171719); border: 1px var(--Label-Normal, #171719) solid"></div>
                                            </div>
                                            <div data-ratio="1:1" style="flex: 1 1 0; overflow: hidden; flex-direction: column; justify-content: flex-start; align-items: flex-start; display: flex">
                                                <div style="flex: 1 1 0; transform: rotate(-37deg); transform-origin: top left; flex-direction: column; justify-content: center; align-items: center; display: flex"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="width: 20px; height: 20px; left: 0px; top: 0px; position: absolute; background: #475569"></div>
                                </div>
                                <div style="width: 28px; height: 28px; left: -4px; top: -4px; position: absolute; opacity: 0.50">
                                    <div data-state="Normal" style="width: 28px; height: 28px; left: 0px; top: 0px; position: absolute; opacity: 0; background: var(--Label-Normal, #171719); border-radius: 1000px"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="align-self: stretch; height: 25px; justify-content: flex-start; align-items: center; gap: 9px; display: inline-flex">
                        <div data-property-1="원형-S-none" style="width: 156px; height: 32px; padding: 16px; background: #F8F8F8; overflow: hidden; border-radius: 99px; outline: 1px var(--Neutral-Color-3, #C1C1C1) solid; outline-offset: -1px; justify-content: center; align-items: center; gap: 4px; display: flex">
                            <div style="color: var(--Neutral-Color-6, #757575); font-size: 12px; font-family: Pretendard; font-weight: 600; line-height: 18px; word-wrap: break-word">채팅하기</div>
                        </div>
                        <div data-property-1="원형-S-Default" style="width: 156px; height: 32px; padding: 16px; background: var(--tishoo-Cyan, #1E78FF); overflow: hidden; border-radius: 99px; justify-content: center; align-items: center; gap: 4px; display: flex">
                            <div style="color: var(--Static-White, white); font-size: 12px; font-family: Pretendard; font-weight: 600; line-height: 18px; word-wrap: break-word">제안하기</div>
                        </div>
                    </div>
                </div>
            </div>
            <div style="align-self: stretch; height: 117px; padding-left: 11px; padding-right: 11px; padding-top: 16px; padding-bottom: 16px; background: var(--Gradient, white); box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.08); overflow: hidden; border-radius: 12px; outline: 1px #CBD5E1 solid; outline-offset: -1px; justify-content: center; align-items: center; display: inline-flex">
                <div style="flex: 1 1 0; flex-direction: column; justify-content: center; align-items: flex-start; gap: 14px; display: inline-flex">
                    <div style="align-self: stretch; justify-content: space-between; align-items: flex-start; display: inline-flex">
                        <div style="width: 174px; justify-content: flex-start; align-items: flex-start; gap: 12px; display: flex">
                            <img style="width: 42px; height: 42px; padding: 10px; border-radius: 99px" src="https://placehold.co/42x42" />
                            <div style="width: 160px; align-self: stretch; flex-direction: column; justify-content: center; align-items: flex-start; gap: 12px; display: inline-flex">
                                <div style="align-self: stretch; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 4px; display: flex">
                                    <div style="align-self: stretch; justify-content: flex-start; align-items: center; gap: 12px; display: inline-flex">
                                        <div style="justify-content: center; display: flex; flex-direction: column; color: #16181C; font-size: 14px; font-family: Pretendard Variable; font-weight: 600; word-wrap: break-word">이수아</div>
                                        <div style="justify-content: center; display: flex; flex-direction: column; color: var(--Neutral-Color-6, #757575); font-size: 10px; font-family: Pretendard Variable; font-weight: 400; word-wrap: break-word">매주 목요일 가능</div>
                                    </div>
                                    <div style="align-self: stretch; justify-content: flex-start; align-items: center; gap: 4px; display: inline-flex">
                                        <div style="justify-content: center; display: flex; flex-direction: column; color: #475569; font-size: 12px; font-family: Pretendard Variable; font-weight: 400; word-wrap: break-word">JavaScript</div>
                                        <div style="justify-content: center; display: flex; flex-direction: column; color: #475569; font-size: 15px; font-family: Pretendard Variable; font-weight: 400; word-wrap: break-word">·</div>
                                        <div style="justify-content: center; display: flex; flex-direction: column; color: #475569; font-size: 12px; font-family: Pretendard Variable; font-weight: 400; word-wrap: break-word">Python</div>
                                        <div style="justify-content: center; display: flex; flex-direction: column; color: #475569; font-size: 15px; font-family: Pretendard Variable; font-weight: 400; word-wrap: break-word">·</div>
                                        <div style="justify-content: center; display: flex; flex-direction: column; color: #475569; font-size: 12px; font-family: Pretendard Variable; font-weight: 400; word-wrap: break-word">Notion</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="height: 20px; justify-content: center; align-items: center; display: flex">
                            <div data-active="False" style="align-self: stretch; position: relative; flex-direction: column; justify-content: center; align-items: center; display: inline-flex">
                                <div style="flex: 1 1 0; position: relative; justify-content: center; align-items: center; display: inline-flex">
                                    <div style="align-self: stretch; flex-direction: column; justify-content: center; align-items: center; display: inline-flex">
                                        <div data-fill="False" data-name="bookmark" style="flex: 1 1 0; position: relative; flex-direction: column; justify-content: center; align-items: center; display: flex">
                                            <div style="width: 20px; height: 20px; left: 0px; top: 0px; position: absolute">
                                                <div style="width: 13.17px; height: 16.50px; left: 3.42px; top: 2.17px; position: absolute; background: var(--Label-Normal, #171719); border: 1px var(--Label-Normal, #171719) solid"></div>
                                            </div>
                                            <div data-ratio="1:1" style="flex: 1 1 0; overflow: hidden; flex-direction: column; justify-content: flex-start; align-items: flex-start; display: flex">
                                                <div style="flex: 1 1 0; transform: rotate(-37deg); transform-origin: top left; flex-direction: column; justify-content: center; align-items: center; display: flex"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="width: 20px; height: 20px; left: 0px; top: 0px; position: absolute; background: #475569"></div>
                                </div>
                                <div style="width: 28px; height: 28px; left: -4px; top: -4px; position: absolute; opacity: 0.50">
                                    <div data-state="Normal" style="width: 28px; height: 28px; left: 0px; top: 0px; position: absolute; opacity: 0; background: var(--Label-Normal, #171719); border-radius: 1000px"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="align-self: stretch; height: 25px; justify-content: flex-start; align-items: center; gap: 9px; display: inline-flex">
                        <div data-property-1="원형-S-none" style="width: 156px; height: 32px; padding: 16px; background: #F8F8F8; overflow: hidden; border-radius: 99px; outline: 1px var(--Neutral-Color-3, #C1C1C1) solid; outline-offset: -1px; justify-content: center; align-items: center; gap: 4px; display: flex">
                            <div style="color: var(--Neutral-Color-6, #757575); font-size: 12px; font-family: Pretendard; font-weight: 600; line-height: 18px; word-wrap: break-word">채팅하기</div>
                        </div>
                        <div data-property-1="원형-S-Default" style="width: 156px; height: 32px; padding: 16px; background: var(--tishoo-Cyan, #1E78FF); overflow: hidden; border-radius: 99px; justify-content: center; align-items: center; gap: 4px; display: flex">
                            <div style="color: var(--Static-White, white); font-size: 12px; font-family: Pretendard; font-weight: 600; line-height: 18px; word-wrap: break-word">제안하기</div>
                        </div>
                    </div>
                </div>
            </div>
            <div style="align-self: stretch; height: 117px; padding-left: 11px; padding-right: 11px; padding-top: 16px; padding-bottom: 16px; background: var(--Gradient, white); box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.08); overflow: hidden; border-radius: 12px; outline: 1px #CBD5E1 solid; outline-offset: -1px; justify-content: center; align-items: center; display: inline-flex">
                <div style="flex: 1 1 0; flex-direction: column; justify-content: center; align-items: flex-start; gap: 14px; display: inline-flex">
                    <div style="align-self: stretch; justify-content: space-between; align-items: flex-start; display: inline-flex">
                        <div style="width: 174px; justify-content: flex-start; align-items: flex-start; gap: 12px; display: flex">
                            <img style="width: 42px; height: 42px; padding: 10px; border-radius: 99px" src="https://placehold.co/42x42" />
                            <div style="width: 160px; align-self: stretch; flex-direction: column; justify-content: center; align-items: flex-start; gap: 12px; display: inline-flex">
                                <div style="align-self: stretch; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 4px; display: flex">
                                    <div style="align-self: stretch; justify-content: flex-start; align-items: center; gap: 12px; display: inline-flex">
                                        <div style="justify-content: center; display: flex; flex-direction: column; color: #16181C; font-size: 14px; font-family: Pretendard Variable; font-weight: 600; word-wrap: break-word">김아름</div>
                                        <div style="justify-content: center; display: flex; flex-direction: column; color: var(--Neutral-Color-6, #757575); font-size: 10px; font-family: Pretendard Variable; font-weight: 400; word-wrap: break-word">매주 수요일 가능</div>
                                    </div>
                                    <div style="align-self: stretch; justify-content: flex-start; align-items: center; gap: 4px; display: inline-flex">
                                        <div style="justify-content: center; display: flex; flex-direction: column; color: #475569; font-size: 12px; font-family: Pretendard Variable; font-weight: 400; word-wrap: break-word">React</div>
                                        <div style="justify-content: center; display: flex; flex-direction: column; color: #475569; font-size: 15px; font-family: Pretendard Variable; font-weight: 400; word-wrap: break-word">·</div>
                                        <div style="justify-content: center; display: flex; flex-direction: column; color: #475569; font-size: 12px; font-family: Pretendard Variable; font-weight: 400; word-wrap: break-word">Node</div>
                                        <div style="justify-content: center; display: flex; flex-direction: column; color: #475569; font-size: 15px; font-family: Pretendard Variable; font-weight: 400; word-wrap: break-word">·</div>
                                        <div style="justify-content: center; display: flex; flex-direction: column; color: #475569; font-size: 12px; font-family: Pretendard Variable; font-weight: 400; word-wrap: break-word">Prisma</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="height: 20px; justify-content: center; align-items: center; display: flex">
                            <div data-active="False" style="align-self: stretch; position: relative; flex-direction: column; justify-content: center; align-items: center; display: inline-flex">
                                <div style="flex: 1 1 0; position: relative; justify-content: center; align-items: center; display: inline-flex">
                                    <div style="align-self: stretch; flex-direction: column; justify-content: center; align-items: center; display: inline-flex">
                                        <div data-fill="False" data-name="bookmark" style="flex: 1 1 0; position: relative; flex-direction: column; justify-content: center; align-items: center; display: flex">
                                            <div style="width: 20px; height: 20px; left: 0px; top: 0px; position: absolute">
                                                <div style="width: 13.17px; height: 16.50px; left: 3.42px; top: 2.17px; position: absolute; background: var(--Label-Normal, #171719); border: 1px var(--Label-Normal, #171719) solid"></div>
                                            </div>
                                            <div data-ratio="1:1" style="flex: 1 1 0; overflow: hidden; flex-direction: column; justify-content: flex-start; align-items: flex-start; display: flex">
                                                <div style="flex: 1 1 0; transform: rotate(-37deg); transform-origin: top left; flex-direction: column; justify-content: center; align-items: center; display: flex"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="width: 20px; height: 20px; left: 0px; top: 0px; position: absolute; background: #475569"></div>
                                </div>
                                <div style="width: 28px; height: 28px; left: -4px; top: -4px; position: absolute; opacity: 0.50">
                                    <div data-state="Normal" style="width: 28px; height: 28px; left: 0px; top: 0px; position: absolute; opacity: 0; background: var(--Label-Normal, #171719); border-radius: 1000px"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="align-self: stretch; height: 25px; justify-content: flex-start; align-items: center; gap: 9px; display: inline-flex">
                        <div data-property-1="원형-S-none" style="width: 156px; height: 32px; padding: 16px; background: #F8F8F8; overflow: hidden; border-radius: 99px; outline: 1px var(--Neutral-Color-3, #C1C1C1) solid; outline-offset: -1px; justify-content: center; align-items: center; gap: 4px; display: flex">
                            <div style="color: var(--Neutral-Color-6, #757575); font-size: 12px; font-family: Pretendard; font-weight: 600; line-height: 18px; word-wrap: break-word">채팅하기</div>
                        </div>
                        <div data-property-1="원형-S-Default" style="width: 156px; height: 32px; padding: 16px; background: var(--tishoo-Cyan, #1E78FF); overflow: hidden; border-radius: 99px; justify-content: center; align-items: center; gap: 4px; display: flex">
                            <div style="color: var(--Static-White, white); font-size: 12px; font-family: Pretendard; font-weight: 600; line-height: 18px; word-wrap: break-word">제안하기</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
`;

function pxToRem(str) {
  return str.replace(/([\d.]+)px/g, (_, v) => {
    const px = parseFloat(v);
    const rem = (px / 16).toFixed(4)  
      .replace(/0+$/,'')              
      .replace(/\.$/, '');            
    return `${rem}rem`;
  });
}

const converted = pxToRem(html);
console.log(converted);
